<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\historial_emp;
use App\Models\usuario;
use App\Models\empleado;

class historial_empController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historial_emp = historial_emp::all();
        return response()->json([
            'historial_emp' => $historial_emp
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $historial_emp = historial_emp::create($request->all());
        return response()->json([
            'message' => "historial_emp saved successfully!",
            'historial_emp' => $historial_emp
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $historial_emp = historial_emp::find($id);
        $usuario = usuario::where('id_usuario', $id)->get();
        $historial_emp->id_usuario = $usuario;
        return response()->json([
            'message' => "Data obtained!",
            'historial_emp' => $historial_emp
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function historialUsuario($id_usuario,$fecha)
    {   
        // array para guardar los valores del foreach
        $historialEMP = [];

        $historial_emp = historial_emp::where('id_usuario',$id_usuario)->where('fecha',$fecha)->get();

        // recorremos los datos recuperados
        foreach($historial_emp as $historial){
            
            $usuario = usuario::where('id_usuario',$id_usuario)->get('id_empleado');

            $empleado = empleado::where('id_empleado', $id_usuario)->get(['id_empleado','nombres','apellidos']);

            $historial->id_usuario = $empleado;

            // almaceno los datos al array
            $historialEMP[] = $historial;
        };

        return response()->json([
                'message' => "Data obtained!",
                'historial_emp' => $historialEMP,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historial_emp $id_historial_emp)
    {
        $id_historial_emp->update($request->all());

        return response()->json([
            'message' => "historial_emp updated successfully!",
            'historial_emp' => $id_historial_emp
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(historial_emp $id_historial_emp)
    {
        $id_historial_emp->delete();

        return response()->json([
            'message' => "historial_emp deleted successfully!",
        ], 200);
    }
}
