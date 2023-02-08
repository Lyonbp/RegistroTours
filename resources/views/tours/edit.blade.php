@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/tours/'.$tours->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
 
@include('tours.form',['modo'=>'Editar']);

</form>
</div>
@endsection