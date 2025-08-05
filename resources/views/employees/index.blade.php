@extends('layouts.app')

@section('content')
<h1>Employees</h1>

<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Company</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="180px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($employees as $employee)
        <tr>
            <td>{{ $employee->company->name ?? '-' }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>
                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete this employee?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No employees found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $employees->links() }}
</div>
@endsection
