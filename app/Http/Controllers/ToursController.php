<?php

namespace App\Http\Controllers;

use App\Models\Tours;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datosTours['tours']=Tours::paginate(100);
        return view('tours.index',$datosTours );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Departamento'=>'required|string|max:100',
            'RHistorica'=>'required|string|max:10000',
            'LugarTour'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];

        $mensaje=[
            'required'=>'El :attribute es Requerido',
            'Foto.required'=>'La Foto Requerida',

        ];

        $this->validate($request,$campos,$mensaje);

        //$datostours = request()->all();
        $datosTours = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosTours['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        Tours::insert($datosTours);

        //return response()->json($datosTours);
        return redirect('tours')->with('mensaje','Tour Agregado Con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function show(Tours $tours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tours=tours::findOrFail($id);
        return view('tours.edit', compact('tours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Departamento'=>'required|string|max:100',
            'RHistorica'=>'required|string|max:10000 ',
            'LugarTour'=>'required|string|max:100',
            

        ];

        $mensaje=[
            'required'=>'El :attribute es Requerido',
            

        ];

        if($request->hasFile('Foto')){
           $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
           $mensaje=['Foto.required'=>'La Foto Requerida'];
        }

        $this->validate($request,$campos,$mensaje);

        //
        $datosTours = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $tours=tours::findOrFail($id);

            Storage::delete('public/'.$tours->Foto); 

            $datosTours['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Tours::where('id','=',$id)->update($datosTours);
        $tours=tours::findOrFail($id);  
        //return view('tours.edit', compact('tours'));
        
        return redirect('tours')->with('mensaje','Tour Modificado');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $tours=tours::findOrFail($id); 

        if(Storage::delete('public/'.$tours->Foto)){

            Tours::destroy($id);
        }

        
        return redirect('tours')->with('mensaje','Tour Eliminado Con Exito');;
    }
}
