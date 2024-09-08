<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // Listar menus
    public function all()
    {
        $menus = Menu::all();
        return response()->json($menus, 200);
    }

    // Buscar un menu por ID
    public function find($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            return response()->json($menu, 200);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    // Crear un nuevo menu
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu = Menu::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($menu, 201);

    }

    // Actualizar un menu por ID
    public function update(Request $request, $id)
    {
        // Buscar el menu por su ID
        $menu = Menu::find($id);

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
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->delete();
        return response()->json(['message' => 'Menu deleted'], 200);
    }
}
