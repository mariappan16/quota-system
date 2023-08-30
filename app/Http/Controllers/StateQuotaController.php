<?php

namespace App\Http\Controllers;

use App\Models\OverallQuota;
use App\Models\State;
use App\Models\Gender;
use App\Models\StateQuota;
use App\Models\Sport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class StateQuotaController extends Controller
{
    public function create(Request $request)
    {

        $sports = Sport::all();
        $genders = Gender::all();
        $categories = Category::all();

        return view('state_quotas.create', compact('genders', 'sports', 'categories'));
    }

    public function getStatesForCategory(Request $request, $sportId, $genderId, $categoryId)
    {
        $overallQuota = OverallQuota::where([
            'sport_id' => $sportId,
            'gender_id' => $genderId,
            'category_id' => $categoryId,
        ])->first();
    
        if (!$overallQuota) {
            return response()->json(['error' => 'Overall quota not available for this combination.'], 400);
        }

        $states = State::all();

        return response()->json($states);

    }


    public function store(Request $request)
    {
        $overallQuota = OverallQuota::where([
            'sport_id' => $request->input('sport'),
            'gender_id' => $request->input('gender'),
            'category_id' => $request->input('category'),
        ])->first();


        if (!$overallQuota) {
            return response()->json(['error' => 'Overall quota not available for this combination.'], 400);
        }
        $totalMinQuota = 0;
        $totalMaxQuota = 0;
        $totalReserveQuota = 0;
        
        foreach ($request->all() as $key => $value) {

            if (str_starts_with($key, 'min_quota_')) {
                $stateId = substr($key, strlen('min_quota_'));
                $totalMinQuota += $value;
                $totalMaxQuota += $request->input('max_quota_' . $stateId);
                $totalReserveQuota += $request->input('reserve_quota_' . $stateId);
            }
        }

        if ($totalMinQuota < $overallQuota->min_quota || $totalMaxQuota > $overallQuota->max_quota) {
            return response()->json(['error' => 'Quota values are outside the overall quota bounds.'], 400);
        }
        
        if ($totalReserveQuota !== $overallQuota->reserve_quota) {
            return response()->json(['error' => 'Reserve quota does not match the overall reserve quota.'], 400);
        }

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'min_quota_')) {
                $stateId = substr($key, strlen('min_quota_'));
                $stateQuota = new StateQuota([
                    'overall_quota_id' => $overallQuota->id,
                    'state_id' => $stateId,
                    'min_quota' => $value,
                    'max_quota' => $request->input('max_quota_' . $stateId),
                    'reserve_quota' => $request->input('reserve_quota_' . $stateId),
                ]);
                $stateQuota->save();
            }
        }

        return response()->json(['message' => 'State Quota stored successfully.', 'redirect' => route('state-quotas.create')], 200);
    }
}
