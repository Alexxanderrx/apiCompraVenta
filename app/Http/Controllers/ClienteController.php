<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (Cliente::find($id) == null) {
            return "No existe un Cliente con el id N° " . $id;
        }
        if (Cliente::find($id)->state == 0) {
            return "El Vendedor N° " . $id . " esta desactivado.";
        }
        return Cliente::find($id);
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

        $nuevoCliente = new Cliente();
        $nuevoCliente->nombre = $request->nombre;
        $nuevoCliente->apellidos = $request->apellidos;
        $nuevoCliente->sexo = $request->sexo;
        $nuevoCliente->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevoCliente->tipo_documento = $request->tipo_documento;
        $nuevoCliente->num_documento = $request->num_documento;
        $nuevoCliente->direccion = $request->direccion;
        $nuevoCliente->telefono = $request->telefono;
        $nuevoCliente->state = 1;
        // $nuevoCliente->create($request->all());
        $nuevoCliente->save();
        return "Cliente Registrado Correctamente.";
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


        if (Cliente::find($id) != null) {
            $updateCliente = Cliente::find($id);

            $updateCliente->nombre = $request->nombre;
            $updateCliente->apellidos = $request->apellidos;
            $updateCliente->sexo = $request->sexo;
            $updateCliente->fecha_nacimiento = $request->fecha_nacimiento;
            $updateCliente->tipo_documento = $request->tipo_documento;
            $updateCliente->num_documento = $request->num_documento;
            $updateCliente->direccion = $request->direccion;
            $updateCliente->telefono = $request->telefono;

            if ($request->state == 1 || $request->state == 0) {
                $updateCliente->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateCliente->save();
            return "Cliente Actualizado Correctamente.";
        } else {
            return "No existe un Cliente con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteCliente = Cliente::find($id);
        if ($deleteCliente == null) {
            return "No existe el cliente N° " . $num . ".";
        }
        $deleteCliente->state = 0;
        $deleteCliente->save();
        return "El cliente N° " . $num . " ha sido eliminado.";
    }
}
