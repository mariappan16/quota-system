@extends('layouts.app')
@section('content')
<div>
    <h1 class="title">Overall Quotas</h1>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Sport</th>
                    <th>Gender</th>
                    <th>Category</th>
                    <th>Min Quota</th>
                    <th>Max Quota</th>
                    <th>Reserve Quota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($overallQuotas as $overallQuota)
                    <tr>
                        <td>{{ $overallQuota->sport->name }}</td>
                        <td>{{ $overallQuota->gender->name }}</td>
                        <td>{{ $overallQuota->category->name }}</td>
                        <td>{{ $overallQuota->min_quota }}</td>
                        <td>{{ $overallQuota->max_quota }}</td>
                        <td>{{ $overallQuota->reserve_quota }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection