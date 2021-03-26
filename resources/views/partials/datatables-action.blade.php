@can($editGate)
  <a href="{{route('admin.' . $crudRoutePart . '.edit', $row->id)}}" class="btn btn-success btn-sm">edit</a>
@endcan

@can($showGate)
  <a href="{{route('admin.' . $crudRoutePart . '.show', $row->id)}}" class="btn btn-primary btn-sm">detail</a>
@endcan

@can($deleteGate)
  @if ($row->id_level !== 1 && $row->getTable() !== 'levels')
    <form action="{{route('admin.'. $crudRoutePart .'.destroy', $row->id)}}" method="POST" class="d-inline-block form-delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
    </form>
  @elseif($row->getTable() === 'levels' && $row->id !== 1)
    <form action="{{route('admin.'. $crudRoutePart .'.destroy', $row->id)}}" method="POST" class="d-inline-block form-delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
    </form>
  @endif
@endcan

