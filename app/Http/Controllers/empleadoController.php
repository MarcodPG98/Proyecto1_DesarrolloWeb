<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleado;

class empleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado = empleado::all();
        return response()->json([
            'empleados' => $empleado
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
        $empleado = empleado::create($request->all());
        return response()->json([
            'message' => "empleado saved successfully!",
            'empleado' => $empleado
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_empleado)
    {
        $empleado = empleado::find($id_empleado);
        return response()->json([
            'message' => "Data obtained!",
            'empleado' => $empleado
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empleado $empleado)
    {
        $empleado->update($request->all());

        return response()->json([
            'message' => "empleado updated successfully!",
            'empleado' => $empleado
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(empleado $empleado)
    {
        $empleado->delete();

        return response()->json([
            'message' => "empleado deleted successfully!",
        ], 200);
    }
}
