<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\CompraDetalles;
use App\Models\Transaccion;
use Illuminate\Http\Request;

class CompraDetallesController extends Controller
{
    public function index()
    {
        return CompraDetalles::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (CompraDetalles::find($id) == null) {
            return "No existe un CompraDetalles con el id N° " . $id;
        }
        if (CompraDetalles::find($id)->state == 0) {
            return "El CompraDetalles N° " . $id . " esta desactivado.";
        }
        return CompraDetalles::find($id);
    }
    public function create(Request $request)
    {
        $request->validate([
            'id_transaccion' => 'required',
            'id_articulo' => 'required',
            'cantidad' => 'required',
            'precio_compra' => ['required', 'string'],
            'descuento' => ['required'],
        ]);

        $nuevoCompraDetalles = new CompraDetalles();

        $TransaccionAll = Transaccion::where('state', '=', 1)->where('id', '=', $request->id_transaccion)->get();
        if (count($TransaccionAll) == 0) {
            return "No existe un curso con ese 'id_transaccion' o esta desactivado, porfavor ingrese un 'id_transaccion' valido.";
        } else {
            $nuevoCompraDetalles->id_transaccion = $request->id_transaccion;
        }

        $ArticuloAll = Articulo::where('state', '=', 1)->where('id', '=', $request->id_articulo)->get();
        if (count($ArticuloAll) == 0) {
            return "No existe un curso con ese 'id_articulo' o esta desactivado, porfavor ingrese un 'id_articulo' valido.";
        } else {
            $nuevoCompraDetalles->id_articulo = $request->id_articulo;
        }

        $nuevoCompraDetalles->cantidad = $request->cantidad;
        $nuevoCompraDetalles->precio_compra = $request->precio_compra;
        $nuevoCompraDetalles->descuento = $request->descuento;
        $nuevoCompraDetalles->state = 1;
        // $nuevoCompraDetalles->create($request->all());
        $nuevoCompraDetalles->save();
        return "CompraDetalles Registrado Correctamente.";
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaccion' => 'required',
            'cantidad' => 'required',
            'precio_compra' => ['required', 'string'],
            'descuento' => ['required'],
            'state' => ['required', 'max:1'],
        ]);


        if (CompraDetalles::find($id) != null) {
            $updateCompraDetalles = CompraDetalles::find($id);

            $TransaccionAll = Transaccion::where('state', '=', 1)->where('id', '=', $request->id_transaccion)->get();
            if (count($TransaccionAll) == 0) {
                return "No existe un curso con ese 'id_transaccion' o esta desactivado, porfavor ingrese un 'id_transaccion' valido.";
            } else {
                $updateCompraDetalles->id_transaccion = $request->id_transaccion;
            }

            $ArticuloAll = Articulo::where('state', '=', 1)->where('id', '=', $request->id_articulo)->get();
            if (count($ArticuloAll) == 0) {
                return "No existe un curso con ese 'id_articulo' o esta desactivado, porfavor ingrese un 'id_articulo' valido.";
            } else {
                $updateCompraDetalles->id_articulo = $request->id_articulo;
            }

            $updateCompraDetalles->cantidad = $request->cantidad;
            $updateCompraDetalles->precio_compra = $request->precio_compra;
            $updateCompraDetalles->descuento = $request->descuento;

            if ($request->state == 1 || $request->state == 0) {
                $updateCompraDetalles->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateCompraDetalles->save();
            return "CompraDetalles Actualizado Correctamente.";
        } else {
            return "No existe un CompraDetalles con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteCompraDetalles = CompraDetalles::find($id);
        if ($deleteCompraDetalles == null) {
            return "No existe el CompraDetalles N° " . $num . ".";
        }
        $deleteCompraDetalles->state = 0;
        $deleteCompraDetalles->save();
        return "El CompraDetalles N° " . $num . " ha sido eliminado.";
    }
}
