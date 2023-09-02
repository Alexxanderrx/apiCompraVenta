<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Transaccion;
use App\Models\VentaDetalles;
use Illuminate\Http\Request;

class VentaDetallesController extends Controller
{
    public function index()
    {
        return VentaDetalles::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (VentaDetalles::find($id) == null) {
            return "No existe un VentaDetalles con el id N° " . $id;
        }
        if (VentaDetalles::find($id)->state == 0) {
            return "El VentaDetalles N° " . $id . " esta desactivado.";
        }
        return VentaDetalles::find($id);
    }
    public function create(Request $request)
    {
        $request->validate([
            'id_transaccion' => 'required',
            'id_articulo' => 'required',
            'cantidad' => 'required',
            'precio_venta' => ['required', 'string'],
            'descuento' => ['required'],
        ]);

        $nuevoVentaDetalles = new VentaDetalles();

        $TransaccionAll = Transaccion::where('state', '=', 1)->where('id', '=', $request->id_transaccion)->get();
        if (count($TransaccionAll) == 0) {
            return "No existe un curso con ese 'id_transaccion' o esta desactivado, porfavor ingrese un 'id_transaccion' valido.";
        } else {
            $nuevoVentaDetalles->id_transaccion = $request->id_transaccion;
        }

        $ArticuloAll = Articulo::where('state', '=', 1)->where('id', '=', $request->id_articulo)->get();
        if (count($ArticuloAll) == 0) {
            return "No existe un curso con ese 'id_articulo' o esta desactivado, porfavor ingrese un 'id_articulo' valido.";
        } else {
            $nuevoVentaDetalles->id_articulo = $request->id_articulo;
        }

        $nuevoVentaDetalles->cantidad = $request->cantidad;
        $nuevoVentaDetalles->precio_venta = $request->precio_venta;
        $nuevoVentaDetalles->descuento = $request->descuento;
        $nuevoVentaDetalles->state = 1;
        // $nuevoVentaDetalles->create($request->all());
        $nuevoVentaDetalles->save();
        return "VentaDetalles Registrado Correctamente.";
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaccion' => 'required',
            'id_articulo' => 'required',
            'cantidad' => 'required',
            'precio_venta' => ['required', 'string'],
            'descuento' => ['required'],
            'state' => ['required', 'max:1'],
        ]);


        if (VentaDetalles::find($id) != null) {
            $updateVentaDetalles = VentaDetalles::find($id);

            $TransaccionAll = Transaccion::where('state', '=', 1)->where('id', '=', $request->id_transaccion)->get();
            if (count($TransaccionAll) == 0) {
                return "No existe un curso con ese 'id_transaccion' o esta desactivado, porfavor ingrese un 'id_transaccion' valido.";
            } else {
                $updateVentaDetalles->id_transaccion = $request->id_transaccion;
            }

            $ArticuloAll = Articulo::where('state', '=', 1)->where('id', '=', $request->id_articulo)->get();
            if (count($ArticuloAll) == 0) {
                return "No existe un curso con ese 'id_articulo' o esta desactivado, porfavor ingrese un 'id_articulo' valido.";
            } else {
                $updateVentaDetalles->id_articulo = $request->id_articulo;
            }
            $updateVentaDetalles->cantidad = $request->cantidad;
            $updateVentaDetalles->precio_venta = $request->precio_venta;
            $updateVentaDetalles->descuento = $request->descuento;

            if ($request->state == 1 || $request->state == 0) {
                $updateVentaDetalles->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateVentaDetalles->save();
            return "VentaDetalles Actualizado Correctamente.";
        } else {
            return "No existe un VentaDetalles con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteVentaDetalles = VentaDetalles::find($id);
        if ($deleteVentaDetalles == null) {
            return "No existe el VentaDetalles N° " . $num . ".";
        }
        $deleteVentaDetalles->state = 0;
        $deleteVentaDetalles->save();
        return "El VentaDetalles N° " . $num . " ha sido eliminado.";
    }
}
