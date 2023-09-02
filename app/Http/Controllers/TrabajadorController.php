<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index()
    {
        return Trabajador::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (Trabajador::find($id) == null) {
            return "No existe un Trabajador con el id N° " . $id;
        }
        if (Trabajador::find($id)->state == 0) {
            return "El Vendedor N° " . $id . " esta desactivado.";
        }
        return Trabajador::find($id);
    }
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
            'sexo' => ['required', 'string'],
            'fecha_nacimiento' => ['required'],
            'tipo_documento' => ['required', 'string'],
            'num_documento' => ['required', 'max:9'],
            'direccion' => ['required', 'string'],
            'telefono' => ['required', 'string'],
        ]);

        $nuevoTrabajador = new Trabajador();
        $nuevoTrabajador->nombre = $request->nombre;
        $nuevoTrabajador->apellidos = $request->apellidos;
        $nuevoTrabajador->sexo = $request->sexo;
        $nuevoTrabajador->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevoTrabajador->tipo_documento = $request->tipo_documento;
        $nuevoTrabajador->num_documento = $request->num_documento;
        $nuevoTrabajador->direccion = $request->direccion;
        $nuevoTrabajador->telefono = $request->telefono;
        $nuevoTrabajador->state = 1;
        // $nuevoTrabajador->create($request->all());
        $nuevoTrabajador->save();
        return "Trabajador Registrado Correctamente.";
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
            'sexo' => ['required', 'string'],
            'fecha_nacimiento' => ['required'],
            'tipo_documento' => ['required', 'string'],
            'num_documento' => ['required', 'max:9'],
            'direccion' => ['required', 'string'],
            'telefono' => ['required', 'string'],
            'state' => ['required', 'max:1'],
        ]);


        if (Trabajador::find($id) != null) {
            $updateTrabajador = Trabajador::find($id);
            $updateTrabajador = Trabajador::find($id);

            $updateTrabajador->nombre = $request->nombre;
            $updateTrabajador->apellidos = $request->apellidos;
            $updateTrabajador->sexo = $request->sexo;
            $updateTrabajador->fecha_nacimiento = $request->fecha_nacimiento;
            $updateTrabajador->tipo_documento = $request->tipo_documento;
            $updateTrabajador->num_documento = $request->num_documento;
            $updateTrabajador->direccion = $request->direccion;
            $updateTrabajador->telefono = $request->telefono;

            if ($request->state == 1 || $request->state == 0) {
                $updateTrabajador->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateTrabajador->save();
            return "Trabajador Actualizado Correctamente.";
        } else {
            return "No existe un Trabajador con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteTrabajador = Trabajador::find($id);
        if ($deleteTrabajador == null) {
            return "No existe el Trabajador N° " . $num . ".";
        }
        $deleteTrabajador->state = 0;
        $deleteTrabajador->save();
        return "El Trabajador N° " . $num . " ha sido eliminado.";
    }
}
