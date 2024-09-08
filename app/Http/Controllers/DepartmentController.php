<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Listar todos los departamentos
    public function all()
    {
        $departments = Department::all();
        return response()->json($departments, 200);
    }

    // Buscar un departamento por ID
    public function find($id)
    {
        $department = Department::find($id);
        if ($department) {
            return response()->json($department, 200);
        } else {
            return response()->json(['message' => 'Department not found'], 404);
        }
    }

    // Crear un nuevo departamento
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $department = Department::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($department, 201);

    }

    // Actualizar un departamento por ID
    public function update(Request $request, $id)
    {
        // Buscar el departamento por su ID
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualizar los campos del departamento
        $department->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($department, 200);
    }

    // Eliminar un departamento por ID
    public function delete($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $department->delete();
        return response()->json(['message' => 'Department deleted'], 200);
    }
}
