@extends('layouts.app')
@section('content')
<div class="container">

   
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje') }}
        
  
      </div>
        @endif

      


<a href="{{url('tours/create')}}" class="btn btn-success" >Registra Nuevo Tour</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Departamento</th>
            <th>RHistorica</th>
            <th>LugarTour</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tours as $tours)
        <tr>
            <td>{{$tours->id}}</td>


            <td>
                <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$tours->Foto}}" width="200" alt="">
                
            </td>


            <td>{{$tours->Departamento}}</td>
            <td>{{$tours->RHistorica}}</td>
            <td>{{$tours->LugarTour}}</td>
            <td>
                <a href="{{url('/tours/'.$tours->id.'/edit')}}/" class="btn btn-warning">
                    EDITAR
                </a> 
                
                 ||

                <form action="{{url('/tours/'.$tours->id)}}" class="d-inline" method="POST">
                @csrf
                {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres Borrar?')" value="Borrar">

                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection