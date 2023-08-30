<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Gender;
use App\Models\Category;
use App\Models\OverallQuota;
use Illuminate\Http\Request;

class OverallQuotaController extends Controller
{
    public function create(Request $request)
    {
        $sports = Sport::all();
        $genders = Gender::all();
        $categories = Category::all();
        return view('overall_quotas.create', compact('sports', 'genders', 'categories'));
    }

    public function index(Request $request)
    {
        $overallQuotas = OverallQuota::with(['sport', 'gender', 'category'])->get();

        return view('overall_quotas.index', ['overallQuotas' => $overallQuotas]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sport' => 'required|exists:sports,id',
            'gender' => 'required|exists:genders,id',
            'category' => 'required|exists:categories,id',
            'min_quota' => 'required|numeric|min:0',
            'max_quota' => 'required|numeric|min:' . $request->input('min_quota'),
            'reserve_quota' => 'required|numeric|min:0',
        ]);

        $sport = Sport::findOrFail($validatedData['sport']);
        $gender = Gender::findOrFail($validatedData['gender']);
        $category = Category::findOrFail($validatedData['category']);

        OverallQuota::updateOrCreate(
            ['sport_id' => $sport->id, 'gender_id' => $gender->id, 'category_id' => $category->id],
            ['min_quota' => $validatedData['min_quota'], 'max_quota' => $validatedData['max_quota'], 'reserve_quota' => $validatedData['reserve_quota']]
        );

        return redirect()->route('state-quotas.create')->with('success', 'Overall Quota stored successfully.');
    }

    public function getCategories($sportId, $genderId)
    {
        $categories = Category::where('sport_id', $sportId)
            ->where('gender_id', $genderId)
            ->get();

        return response()->json($categories);
    }

    public function getOverallQuota(Request $request, $sportId, $genderId, $categoryId)
    {
        $overallQuota = OverallQuota::where([
            'sport_id' => $sportId,
            'gender_id' => $genderId,
            'category_id' => $categoryId,
        ])->first();
    
        if (!$overallQuota) {
            return response()->json(['error' => 'Overall quota not available for this combination.'], 400);
        }


        return response()->json($overallQuota);
    }
}
