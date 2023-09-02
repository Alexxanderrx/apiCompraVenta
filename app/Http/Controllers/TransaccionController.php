<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    public function index()
    {
        return Transaccion::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (Transaccion::find($id) == null) {
            return "No existe un Transaccion con el id N° " . $id;
        }
        if (Transaccion::find($id)->state == 0) {
            return "El Vendedor N° " . $id . " esta desactivado.";
        }
        return Transaccion::find($id);
    }
    public function create(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_trabajador' => 'required',
            'fecha' => ['required', 'string'],
            'tipo_comprobante' => ['required', 'string'],
            'serie' => ['required', 'string', 'max:8'],
            'igv' => 'required',
            'tipo' => ['required', 'string'],
        ]);

        $nuevoTransaccion = new Transaccion();
        $nuevoTransaccion->id_cliente = $request->id_cliente;
        $nuevoTransaccion->id_trabajador = $request->id_trabajador;
        $nuevoTransaccion->fecha = $request->fecha;
        $nuevoTransaccion->tipo_comprobante = $request->tipo_comprobante;
        $nuevoTransaccion->serie = $request->serie;
        $nuevoTransaccion->igv = $request->igv;
        if ($nuevoTransaccion->tipo == "venta" || $nuevoTransaccion->tipo == "compra") {
            $nuevoTransaccion->tipo = $request->tipo;
        } else {
            return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
        }
        $nuevoTransaccion->state = 1;
        // $nuevoTransaccion->create($request->all());
        $nuevoTransaccion->save();
        return "Transaccion Registrado Correctamente.";
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_trabajador' => 'required',
            'fecha' => ['required', 'string'],
            'tipo_comprobante' => ['required', 'string'],
            'serie' => ['required', 'string', 'max:8'],
            'igv' => 'required',
            'tipo' => ['required', 'string'],
            'state' => ['required', 'max:1'],
        ]);


        if (Transaccion::find($id) != null) {
            $updateTransaccion = Transaccion::find($id);
            $updateTransaccion = Transaccion::find($id);

            $updateTransaccion->id_cliente = $request->id_cliente;
            $updateTransaccion->id_trabajador = $request->id_trabajador;
            $updateTransaccion->fecha = $request->fecha;
            $updateTransaccion->tipo_comprobante = $request->tipo_comprobante;
            $updateTransaccion->serie = $request->serie;
            $updateTransaccion->igv = $request->igv;
            if ($updateTransaccion->tipo == "venta" || $updateTransaccion->tipo == "compra") {
                $updateTransaccion->tipo = $request->tipo;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            if ($request->state == 1 || $request->state == 0) {
                $updateTransaccion->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateTransaccion->save();
            return "Transaccion Actualizado Correctamente.";
        } else {
            return "No existe un Transaccion con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteTransaccion = Transaccion::find($id);
        if ($deleteTransaccion == null) {
            return "No existe el Transaccion N° " . $num . ".";
        }
        $deleteTransaccion->state = 0;
        $deleteTransaccion->save();
        return "El Transaccion N° " . $num . " ha sido eliminado.";
    }
}
