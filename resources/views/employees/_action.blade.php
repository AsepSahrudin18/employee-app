<form method="POST" action="{{ route('employees.destroy', $employee->id) }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-btn" data-id="{{ $employee->id }}">Delete</button>
</form>

<a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-primary">View</a>
<button class="btn btn-sm btn-warning" onclick="fillUpdateModal({{ $employee }})">Edit</button>
