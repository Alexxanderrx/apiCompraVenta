<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        return Articulo::where('state', '=', 1)->get();
    }
    public function getById($id)
    {
        if (Articulo::find($id) == null) {
            return "No existe un Articulo con el id N° " . $id;
        }
        if (Articulo::find($id)->state == 0) {
            return "El Articulo N° " . $id . " esta desactivado.";
        }
        return Articulo::find($id);
    }
    public function create(Request $request)
    {
        $request->validate([
            'codigo' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock_inicial' => ['required', 'string'],
            'stock_actual' => ['required', 'string'],
            'fecha_produccion' => 'required',
            'fecha_vencimiento' => 'required',
        ]);

        $nuevoArticulo = new Articulo();
        $nuevoArticulo->codigo = $request->codigo;
        $nuevoArticulo->nombre = $request->nombre;
        $nuevoArticulo->description = $request->description;
        $nuevoArticulo->stock_inicial = $request->stock_inicial;
        $nuevoArticulo->stock_actual = $request->stock_actual;
        $nuevoArticulo->fecha_produccion = $request->fecha_produccion;
        $nuevoArticulo->fecha_vencimiento = $request->fecha_vencimiento;
        $nuevoArticulo->state = 1;
        // $nuevoArticulo->create($request->all());
        $nuevoArticulo->save();
        return "Articulo Registrado Correctamente.";
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock_inicial' => ['required', 'string'],
            'stock_actual' => ['required', 'string'],
            'fecha_produccion' => 'required',
            'fecha_vencimiento' => 'required',
            'state' => ['required', 'max:1'],
        ]);


        if (Articulo::find($id) != null) {
            $updateArticulo = Articulo::find($id);


            $updateArticulo->codigo = $request->codigo;
            $updateArticulo->nombre = $request->nombre;
            $updateArticulo->description = $request->description;
            $updateArticulo->stock_inicial = $request->stock_inicial;
            $updateArticulo->stock_actual = $request->stock_actual;
            $updateArticulo->fecha_produccion = $request->fecha_produccion;
            $updateArticulo->fecha_vencimiento = $request->fecha_vencimiento;

            if ($request->state == 1 || $request->state == 0) {
                $updateArticulo->state = $request->state;
            } else {
                return "'state' solo acepta los valores 0 o 1.\n 'state' sin modificaciones.\n";
            }
            $updateArticulo->save();
            return "Articulo Actualizado Correctamente.";
        } else {
            return "No existe un Articulo con ese Id o esta desactivado.";
        }
    }
    public function delete($id)
    {
        $num = $id;
        $deleteArticulo = Articulo::find($id);
        if ($deleteArticulo == null) {
            return "No existe el Articulo N° " . $num . ".";
        }
        $deleteArticulo->state = 0;
        $deleteArticulo->save();
        return "El Articulo N° " . $num . " ha sido eliminado.";
    }
}
