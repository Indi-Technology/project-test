<h1>{{ $company->name }}</h1>
<img src="{{ asset('storage/' . $company->logo) }}" width="100" />
<p>{{ $company->email }}</p>
<p>{{ $company->description }}</p>
