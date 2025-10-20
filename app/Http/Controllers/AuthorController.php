<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        if  ($authors->isEmpty()){
            return response()->json([
                "succes"=> true,
                "message"=> "Resource data not Found!"
            ], 200);
        }

        return response()-> json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'negara' => 'required|string'
        ]);

        // 2. Check VAlidator Error
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Insert Data
        $author = Author::create([
            'name' => $request->name,
            'negara' => $request->negara
        ]);

        // 4. Response
        return response()->json([
            'success' => true,
            'message' => 'Resource added succesfully! ',
            'data' => $author
        ], 201);

    }

    public function show(string $id){
        $author = Author::find($id);

        if (!$author){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $author
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. Mencari Data
        $author = Author::find($id);

        if (!$author){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        // 2. Validasi
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'negara' => 'required|string|max:100'
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
            'negara' => $request->negara
        ];

        // 4. update data baru ke database
        $author->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource update successfully',
            'data' => $author
        ], 200);
    }

    public function destroy(string $id){
        $author = Author::find($id);

        if (!$author){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete resource successfully'
        ]);
    }

}