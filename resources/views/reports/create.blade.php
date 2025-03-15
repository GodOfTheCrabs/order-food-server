@extends('layouts.main')
@section('title', 'Створення звіту')
@section('content')
<div class="container">
    <div class="container d-flex justify-content-center" >
        <div class="card p-4 shadow-sm">
            <h1 class="text-center mb-4">Generate Report</h1>
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Generate Report</button>
            </form>
        </div>
    </div>

</div>
@endsection