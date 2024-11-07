<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Producto::all(), 200);  //respuesta de Api Json Mostrar todos los productos
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar Datos
        $datos = $request->validate([
            'nombre'=> ['required','string','max:100'],
            'descripcion'=> ['nullable','string','max:255'],
            'precio' => ['required', 'integer','min:1000'],
            'stock'=> ['required', 'integer', 'min:1'],
        ]);

         //guardar datos

    $producto = Producto::create($datos);
    //respuesta al cliente
    
    return response()->json([
        'success'=>true,
        'message'=>'producto creado exitosamente',
    ],201);

    }
   
    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //Validar Datos
        $datos=$request->validate([
            'nombre'=>['required','string','max:100'],
            'desctripcion'=>['nullable','string','max:225'],
            'precio' =>['required', 'integer','min:1000'],
            'stock'=> ['required', 'integer', 'min:1'],
        ]);
        
        //actualizar datos

    $producto->update($datos);

    //respuesta al cliente

    return response()->json([
        'success'=>true,
        'message'=>'producto actualizado exitosamente',
    ],200);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        // Respuesta al Cliente
        return response()->json([
            'success'=> true,
            'message' => 'Producto eliminado exitosamente',
        ],204);

    }
}
