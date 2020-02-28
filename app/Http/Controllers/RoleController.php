<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //este metodo solo nos devulve la vista principal de los roles
    public function index()
    {
      $roles = Role::all();

      return response()->json([
          'okey'=>true,
          'roles'=>$roles
      ], 200);
    }

    //Metodo para registrar un nuevo rol (función) 
    public function store(Request $request)
    {
        try {
            $role = Role::create([
                //primer caracter a  mayusculas ucwords.
                'name' => ucwords($request['name']),
                //primer caracter a  mayusculas ucwords. y lo demas en minusculas
                'description' => ucfirst(strtolower($request['description']))
                ]);
            return response()->json([
                'okey'=>true,
                'role'=>$role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'okey'=>false,
                'error' => $th
            ], 402);
        }
    }
    public function edit($id)
    {
        $role = Role::find($id);
        
        return response()->json([
            'okey'=>true,
            'role'=>$role
        ], 200);
    }

    //metodo para actualizar un rol
    public function update(Request $request, $id)
    {
        //busca por el id y nos debuelve el registro encontrado
        $role = Role::find($id);
        $role->name = ucwords($request['name']);
        $role->description = ucfirst(strtolower($request['description']));
        //al final guarda los cambios con save()
        $role->save();

        return response()->json([
            'okey'=>true,
            'role'=>$role
        ], 200);
    }

    //Metodo para eliminar un rol (función)
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        
        return response()->json([
            'okey'=>true,
            'role'=>$role
        ], 200);
    }

    //EXTRAS

    //Selecciona solo dos campos y los devuelve en un array para los <select> 
    public function selectRoles()
    {
        $roles = Role::pluck('name', 'id');
        return $roles;
    }
    
}