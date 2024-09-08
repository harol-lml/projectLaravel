<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmenuController extends Controller
{
    // Listar Submenu
    public function all()
    {
        $menus = Submenu::all();
        return response()->json($menus, 200);
    }

    // Buscar un Submenu por ID
    public function find($id)
    {
        $menu = Submenu::find($id);
        if ($menu) {
            return response()->json($menu, 200);
        } else {
            return response()->json(['message' => 'Submenu not found'], 404);
        }
    }

    // Crear un nuevo Submenu
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'menu_id' => 'required|exists:menus,id', // Validar que el menu_id sea requerido y exista en la tabla menus
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu = Submenu::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'menu_id' => $request->input('menu_id'), // Asociar el submenu con el menu
        ]);

        return response()->json($menu, 201);

    }

    // Actualizar un menu por ID
    public function update(Request $request, $id)
    {
        // Buscar el menu por su ID
        $menu = Submenu::find($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualizar los campos del menu
        $menu->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($menu, 200);
    }

    // Eliminar un menu por ID
    public function delete($id)
    {
        $menu = Submenu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Submenu not found'], 404);
        }

        $menu->delete();
        return response()->json(['message' => 'Submenu deleted'], 200);
    }
}
