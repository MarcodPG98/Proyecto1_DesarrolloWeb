<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\empleado;
use App\Models\historial_emp;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = usuario::all();
        return response()->json([
            'usuarios' => $usuarios
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
        $rules = [
            'usuario' => 'max:15|required',
            'contrasena' => 'min:5|required',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'Ha sobre pasado la longitud máxima del campo :attribute',
            'min' => ':attribute demasiado corta'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => "Información incompleta o inválida -> ".$validator->messages()->first()
            ], 400);
        }

        $usuario = usuario::create($request->all());
        return response()->json([
            'message' => "usuario saved successfully!",
            'usuario' => $usuario
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_usuario)
    {
        $usuario = usuario::find($id_usuario);
        $empleado = empleado::where('id_empleado', $id_usuario)->get();
        $usuario->id_empleado= $empleado;
        return response()->json([
            'message' => "Data obtained!",
            'usuario' => $usuario
        ], 200);
    }

    public function verificarUsuario(Request $request, $usuario){

        // recupero el id del usuario
        $id_usuario = usuario::where('usuario',$usuario)->first()->id_usuario;

        // obtenemos el tipo de entrada
        $historial_emp = historial_emp::where('id_usuario',$id_usuario)->latest('tipo_entrada')->first()->tipo_entrada;

        // comparamos
        if($historial_emp == 1){ // tipo_entrada = 1 ----- > tipo_entrada = 2

            $updateUsuario = DB::table('historial_emp')
              ->where('id_usuario',$id_usuario)
              ->update(['tipo_entrada' => 2]);

            $empleado = empleado::where('id_empleado', $id_usuario)->get(['id_empleado','nombres','apellidos']);

            return response()->json([
                'message' => "empleado updated successfully!",
                'empleado' => $empleado
            ], 200);
        }

        /*
        if($historial_emp == 2){ // tipo entrada = 2 ----- > actualizar fecha y hora
            $historial_emp = historial_emp::where('id_usuario',$id_usuario)->get();
        }
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuario $id_usuario)
    {
        $id_usuario->update($request->all());

        return response()->json([
            'message' => "id_usuario updated successfully!",
            'usuario' => $id_usuario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( usuario $id_usuario)
    {
        $id_usuario->delete();

        return response()->json([
            'message' => "usuario deleted successfully!",
        ], 200);
    }
}
