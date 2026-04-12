@extends('layout.userdashboard')

@section('content')

<div class="container">

<h4>Edit Education</h4>

<form action="{{ route('education.update',$education->id) }}" method="POST">
@csrf

<input type="text" name="degree" value="{{ $education->degree }}" class="form-control mb-2">
<input type="text" name="college" value="{{ $education->college }}" class="form-control mb-2">
<input type="text" name="year" value="{{ $education->year }}" class="form-control mb-2">

<button class="btn btn-success">Update</button>

</form>

</div>

@endsection