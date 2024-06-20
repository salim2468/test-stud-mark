@extends("master")

@section('content')
<div class="container">
<a href="{{route('student.create')}}"><button class="btn btn-primary">Add</button></a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Category Name</th>
        <th scope="col">Detail</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $student)
      <tr>
        <th scope="row">{{ $student->id }}</th>
        <td>{{ $student->name }}</td>
        <td>{{ $student->category->name }}</td>
        <td> <a href="{{route('student.show',['student'=>$student->id])}}"><button type="button" class="btn btn-secondary p-1 d-block">Detail</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
  
@endsection