<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = "Not found material";
        $materials = Material::all();
        if (!$materials) {
            return $message;
        }
        return response()->json(['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material();
        $material->name = $request->name;
        $material->image = $request->image;
        $material->description = $request->description;
        $material->user_id = $request->user_id;
        $material->save();
        return response()->json(['Massage' => "Material was created successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $material = Material::find($id);
        $material->name = $request->name;
        $material->image = $request->image;
        $material->description = $request->description;
        $material->user_id = $request->user_id;
        $material->save();
        return response()->json($material);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = '';
        $material = Material::find($id);
        $material->delete();
        if ($material) {
            $message = "Material was not deleted.";
        } else {
            $message = "Material was deleted successfully.";
        }
        
        return response()->json($message);
    }
}
