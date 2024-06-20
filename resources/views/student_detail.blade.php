@extends("master")

@section('content')
<div class="container">
  {{$student}}
  <hr>
  {{-- <a href="{{ route('mark.addMark',['studentId'=> $student->id]) }}">
    <button type="button" class="btn btn-secondary p-1 d-block">
      Add Marks
    </button>
  </a> --}}

  <form action="{{ route('mark.create') }}" method="GET">
    <select class="form-select" name="class">
      <option value="11">11</option>
      <option value="12">12</option>
    </select>
    <select class="form-select" name="term">
      <option value="1">First</option>
      <option value="2">Second</option>
      <option value="3">Third</option>
    </select>
    <input type="text" class="form" hidden value="{{ $student->id }}" name="studentId"/>
    <button type="submit" class="btn btn-secondary p-1 d-block">
      Add Marks
    </button>
  </form>

</div>


@endsection