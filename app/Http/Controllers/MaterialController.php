<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialResource;
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
        $materialResource = MaterialResource::collection($materials);
        if (!$materials) {
            return $message;
        }
        return response()->json(['materials' => $materialResource]);
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
        $message = "Material was not created";
        $material = new Material();
        $material->name = $request->name;
        $material->image = $request->image;
        // $material->image = "data:image/png;base64,".base64_encode(file_get_contents($request->file('image')));
        $material->description = $request->description;
        $material->user_id = $request->user_id;
        $material->save();
        if($material) {
            $message = "Material was created successfully.";
        }
        return response()->json(['Massage' =>  $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        $material->user;
        $material->comments;
        return response()->json(['materail' => $material]);
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

    public function updateMaterial(Request $request,$id){
        $message = "Material was not updated";
        $material = Material::find($id);
        $material->name = $request->name;
        $material->image = "data:image/png;base64,".base64_encode(file_get_contents($request->file('image')));
        $material->description = $request->description;
        $material->user_id = $request->user_id;
        $material->save();

        if ($material) {
            $message = "Material was updated successfully.";
        }
        return response()->json(['Massage' =>  $message]);
    }

    // public function update(Request $request,$id)
    // {
    //     $message = "Material was not updated";
    //     $material = Material::find($id);
    //     $material->name = $request->name;
    //     $image = "data:image/png;base64,".base64_encode(file_get_contents($request->file('image')));
    //     $material->image = $image;
    //     $material->description = $request->description;
    //     $material->user_id = 1;
    //     $material->save();

    //     if ($material) {
    //         $message = "Material was updated successfully.";
    //     }
    //     return response()->json(['Massage' =>  $message]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = "";
        $material = Material::find($id);
        if(!$material) {
            $message = "Not found material.";
        } else {
            $material->delete();
            $message = "Material was deleted successfully.";
        }
        
        return response()->json(['message' => $message]);
    }
}
