@extends("master")

@section('content')
<div class="container">
  <form method="POST" action="{{ route('student.store') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
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
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
  
@endsection