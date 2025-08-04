<h1>Employees List</h1>
@include('partials.flash')

<a href="{{ route('employees.create') }}">+ Add Employee</a>

<table border="1">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Company</th>
    <th>Actions</th>
</tr>
@foreach ($employees as $item)
<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone }}</td>
    <td>{{ $item->company->name }}</td>
    <td>
        <a href="{{ route('employees.edit', $item->id) }}">Edit</a> |
        <form action="{{ route('employees.destroy', $item->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

{{ $employees->links() }}
