@extends("master")

@section('content')
<div class="container">
  <form method="POST" action="{{ route('subject.store') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Sub Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select class="form-select" id="category_id" name="category_id">
          <option value="">Select Category</option>
          @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
      </select>
      <label for="category_id" class="form-label">Class</label>
      <select class="form-select" name="class">
        <option value="">Select class</option>
            <option value="11">11</option>
            <option value="12">12</option>
    </select>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr>

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($subjects as $subject)
      <tr>
        <td>{{ $subject->id }}</td>
        <td>{{ $subject->name }}</td>
        <td>
        @forelse($subject->categories as $category)
          <span class="badge rounded-pill text-bg-secondary">{{ $category->name }}</span>
          @empty
          @endforelse
        </td>
        <td style="width:100px;">
          <form action="{{ route('subject.destroy', ['id' => $subject->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning p-1" id="hiddenBtn">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>  
</div>
@endsection