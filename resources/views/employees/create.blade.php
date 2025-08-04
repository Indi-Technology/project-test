@extends('layouts.app')

@section('content')
<h1>Add Employee</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Company</label>
        <select name="company_id" class="form-control" required>
            <option value="">-- Select Company --</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
