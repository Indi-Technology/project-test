<h1>Companies List</h1>
@include('partials.flash')

<a href="{{ route('companies.create') }}">+ Add Company</a>

<table border="1">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Logo</th>
    <th>Description</th>
    <th>Actions</th>
</tr>
@foreach ($companies as $item)
<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>
        @if ($item->logo)
            <img src="{{ asset('storage/' . $item->logo) }}" width="100" />
        @endif
    </td>
    <td>{{ $item->description }}</td>
    <td>
        <a href="{{ route('companies.edit', $item->id) }}">Edit</a> |
        <form action="{{ route('companies.destroy', $item->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

{{ $companies->links() }}
