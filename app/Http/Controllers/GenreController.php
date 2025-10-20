<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        if  ($genres->isEmpty()){
            return response()->json([
                "succes"=> true,
                "message"=> "Resource data not Found!"
            ], 200);
        }

        return response()-> json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $genres
        ], 200);
    }

    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        // 2. Check VAlidator Error
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Insert Data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // 4. Response
        return response()->json([
            'success' => true,
            'message' => 'Resource added succesfully! ',
            'data' => $genre
        ], 201);
    }

    public function show(string $id){
        $genre = Genre::find($id);

        if (!$genre){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $genre
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. Mencari Data
        $genre = Genre::find($id);

        if (!$genre){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        // 2. Validasi
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Menyiapkan Data yang ingin diupdate
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        // 4. update data baru ke database
        $genre->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource update successfully',
            'data' => $genre
        ], 200);
    }

    public function destroy(string $id){
        $genre = Genre::find($id);

        if (!$genre){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete resource successfully'
        ]);
    }
}
