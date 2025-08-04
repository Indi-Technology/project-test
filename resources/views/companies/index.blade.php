@extends('layouts.app')

@section('content')
<h1>Companies</h1>
<a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add Company</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Logo</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>
                @if($company->logo)
                    <img src="{{ asset('storage/'.$company->logo) }}" width="50">
                @endif
            </td>
            <td>{{ $company->description }}</td>
            <td>
                <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $companies->links() }}
@endsection
