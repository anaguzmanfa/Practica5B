<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenteController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     */
    public function index()
    {
        $asistentes = Asistente::all();

        $respuesta = [
            'asistentes' => $asistentes,
            'status' => 200,
        ];

        return response()->json($respuesta);
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email|unique:asistentes,email',
            'telefono' => 'required',
            'evento_id' => 'required|exists:eventos,id',
        ]);

        if ($validator->fails()) {
            $respuesta = [
                'message' => 'Datos faltantes',
                'status' => 400,
            ];

            return response()->json($respuesta, 400);
        }

        $asistente = Asistente::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'evento_id' => $request->evento_id,
        ]);

        if (!$asistente) {
            $respuesta = [
                'message' => 'Error al crear el asistente',
                'status' => 500,
            ];

            return response()->json($respuesta, 500);
        }

        $respuesta = [
            'asistente' => $asistente,
            'status' => 201,
        ];

        return response()->json($respuesta, 201);
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show($id)
    {
        $asistente = Asistente::find($id);

        if (!$asistente) {
            $respuesta = [
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ];

            return response()->json($respuesta, 404);
        }

        $respuesta = [
            'asistente' => $asistente,
            'status' => 200,
        ];

        return response()->json($respuesta, 200);
    }

    /**
     * Actualizar el recurso especificado.
     */
    public function update(Request $request, $id)
    {
        $asistente = Asistente::find($id);

        if (!$asistente) {
            $respuesta = [
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ];

            return response()->json($respuesta, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email|unique:asistentes,email,' . $id,
            'telefono' => 'required',
            'evento_id' => 'required|exists:eventos,id',
        ]);

        if ($validator->fails()) {
            $respuesta = [
                'message' => 'Datos faltantes',
                'status' => 400,
            ];

            return response()->json($respuesta, 400);
        }

        $asistente->nombre = $request->nombre;
        $asistente->email = $request->email;
        $asistente->telefono = $request->telefono;
        $asistente->evento_id = $request->evento_id;
        $asistente->save();

        $respuesta = [
            'asistente' => $asistente,
            'status' => 200,
        ];

        return response()->json($respuesta);
    }

    /**
     * Eliminar el recurso especificado.
     */
    public function destroy($id)
    {
        $asistente = Asistente::find($id);

        if (!$asistente) {
            $respuesta = [
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ];

            return response()->json($respuesta, 404);
        }

        $asistente->delete();

        $respuesta = [
            'message' => 'Asistente eliminado',
            'status' => 200,
        ];

        return response()->json($respuesta);
    }
}