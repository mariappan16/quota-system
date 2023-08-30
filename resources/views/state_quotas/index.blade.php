@extends('layouts.app')
@section('content')
<div>
        <h1 class="title">State Quotas</h1>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Overall Quota</th>
                        <th>Min Quota</th>
                        <th>Max Quota</th>
                        <th>Reserve Quota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stateQuotas as $stateQuota)
                        <tr>
                            <td>{{ $stateQuota->state->name }}</td>
                            <td>{{ $stateQuota->overallQuota->sport->name }}, {{ $stateQuota->overallQuota->gender->name }}, {{ $stateQuota->overallQuota->category->name }}</td>
                            <td>{{ $stateQuota->min_quota }}</td>
                            <td>{{ $stateQuota->max_quota }}</td>
                            <td>{{ $stateQuota->reserve_quota }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
</div>
@endsection