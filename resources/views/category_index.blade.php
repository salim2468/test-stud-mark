@extends("master")

@section('content')
<div class="container">
  <form method="POST" action="{{ route('category.store') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr>

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr style="border: 2px solid black;">
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td style="width: 100px;">
          <button onclick="clickBtn({{$category}})" id="hiddenBtn" type="button" class="btn btn-secondary p-1" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            Add
          </button>
        </td>
          <td style="width: 100px;">
          <form action="{{ route('category.destroy', ['categoryId' => $category->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" id="hiddenBtn" class="btn btn-danger p-1">
              Deletes
            </button>
        </form>
      </td>
      </tr>
      <tr>
        @foreach($category->subjects as $subject)
        <tr>
          <td></td>
          <td>{{$loop->iteration . ')  ' . $subject->name }}</td>
          <td style="width:100px;">
            <form action="{{ route('subject.remove', ['sId' => $subject->id,'cId' =>$category->id ]) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" id="hiddenBtn" class="btn btn-warning p-1">
                Removes
              </button>
            </form>
          </td>
          <td></td>
        </tr>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addSubjectForm" method="POST">
        @csrf
        <div class="modal-header">
          ca
          <h1 class="modal-title fs-5" id="addSubjectModalLabel">Select Subject</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select name="class">
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          {{-- @foreach($subjects as $subject) --}}
          <div id="subCheck" class="form-check">
            {{-- <input class="form-check-input" type="checkbox"  name="checkboxes[]" value="{{ $subject->id }}" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              {{ $subject->name }}
            </label> --}}
          </div>
          {{-- @endforeach --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  const modalTitle = document.getElementById('addSubjectModalLabel');

  function clickBtn(category) {
    console.log('hihihihih', category);
    modalTitle.innerHTML=`Select Subject for Category: ${category['name']}`;
    document.getElementById('addSubjectForm').action = `/category/${category['id']}/add-subject`;

    // Make the AJAX GET request
    $.ajax({
      url: '/category/' + category['id'] + '/get-unselected-subject',
      type: 'GET',
      success: function(response) {
          // Clear the existing list
          $('#subCheck').empty();

          // Append the subjects to the list
          $.each(response.data, function(index, subject) {
            console.log('hi'+index);
            console.log(subject);
              $('#subCheck').append(
                '<input class="form-check-input" type="checkbox"  name="checkboxes[]" value="' + subject.id + '" id="flexCheckDefault">'+
            '<label class="form-check-label" for="flexCheckDefault">' + subject.name +
            '</label><br/>');
          });
      },
      error: function(xhr, status, error) {
          console.error('Error fetching subjects:', error);
      }
    });
  }
</script>
@endsection