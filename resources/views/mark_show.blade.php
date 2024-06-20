@extends("master")

@section('content')
<div class="container">
    Marks
    {{-- {{$marks}} --}}
      <table class="table w-25">
        <thead>
          <tr>
            <th scope="col">Subject</th>
            <th scope="col">Marks</th>
          </tr>
        </thead>
        <tbody>
          @foreach($marks as $mark)
          <tr>
            <th scope="row">{{$mark->subject->name}}</th>
            <td>
              {{$mark->marks}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection