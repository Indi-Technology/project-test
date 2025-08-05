@extends('layouts.app')

@section('content')
<h1>Edit Company</h1>
<form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $company->email }}" required>
    </div>
    <div class="mb-3">
        <label>Logo</label>
        @if($company->logo)
            <img src="{{ asset('storage/'.$company->logo) }}" width="50" class="d-block mb-2">
        @endif
        <input type="file" name="logo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $company->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
