
<h1>{{$modo}} Tours</h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
  <ul>
    @foreach( $errors->all() as $error)
    <li> {{$error}} </li>
  @endforeach
  </ul>
</div>

  

@endif

<div class="form-group">

<label form="Departamento"> Departamento </label>
<input type="text" class="form-control" name="Departamento" value="{{isset($tours->Departamento)?$tours->Departamento:old('Departamento')}}" id="Departamento">


</div>

<div class="form-group">

<label form="RHistorica"> Reseña Historica </label>
<input type="text" class="form-control" name="RHistorica" value="{{isset($tours->RHistorica)?$tours->RHistorica:old('RHistorica')}}" id="RHistorica">


</div>

<div class="form-group">

<label form="LugarTour"> LugarTour </label>
<input type="text" class="form-control" name="LugarTour" value="{{isset($tours->LugarTour)?$tours->LugarTour:old('LugarTour')}}" id="LugarTour">


</div>

<div class="form-group">


<label form="Foto"> Foto </label>
@if(isset($tours->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$tours->Foto}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">


</div>

<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a class="btn btn-primay" href="{{url('tours/')}}">Regresar</a>

<br>