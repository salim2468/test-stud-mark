@extends("master")

@section('content')
<div class="container">
    Marks
    {{$existingSubjects}}
    <form action="{{route('mark.store')}}" method="POST">
      @csrf
      {{-- <input type="number" class="form-control" name="{{$subject->name}}" id="exampleFormControlInput1" value="{{ $studentId }}" placeholder=""> --}}

      <table class="table w-25">
        <thead>
          <tr>
            <th scope="col">Subject</th>
            <th scope="col">Marks</th>
          </tr>
        </thead>
        <tbody>
          @foreach($existingSubjects as $subject)
          <tr>
            <th scope="row">{{$subject->name}}</th>
            <td>
              <input hidden  name="studentId" value="{{ $studentId }}">
              <input hidden  name="class" value="{{ $class }}">
              <input hidden  name="term" value="{{ $term }}">
              <input type="number" class="form-control" name="{{$subject->id}}" id="exampleFormControlInput1" value="50" placeholder="">
            </td>
          </tr>
          @endforeach
          <tr>
            <td>
              <button type="submit" class="btn btn-primary">
                Submit
              </button>
            </td>
            <td></td>
          </tr>
        </tbody>
      </table>
  </form>
</div>
@endsection