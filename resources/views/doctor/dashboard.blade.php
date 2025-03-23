@extends('layouts.doctor')

@section('main')
<div class="wide-container mt-5">
    <h3>My Assigned Patients</h3>
    @if($patients->isEmpty())
        <p>No patients assigned to you at this time.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IC</th>
                    <th>Name</th>
                    <th>Date Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->ic }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('doctor.review', $patient->id) }}" class="btn btn-primary btn-sm">Review</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
