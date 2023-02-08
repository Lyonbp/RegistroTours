@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/tours')}}" method="post" enctype="multipart/form-data">
@csrf
@include('tours.form',['modo'=>'Crear']);

</form>
</div>
@endsection