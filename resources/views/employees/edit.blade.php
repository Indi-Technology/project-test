@extends('layouts.app')

@section('content')
<h1>Edit Employee</h1>

<form action="{{ route('employees.update', $employee) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Company</label>
        <select name="company_id" class="form-control" required>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $employee->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $employee->email }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
