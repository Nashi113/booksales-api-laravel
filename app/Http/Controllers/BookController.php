<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
       $books = Book::all();

        if  ($books->isEmpty()){
            return response()->json([
                "succes"=> true,
                "message"=> "Resource data not Found!"
            ], 200);
        }

        return response()-> json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $books
        ], 200);

    }

    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        // 2. Check VAlidator Error
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Upload Image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // 4. Insert Data
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id
        ]);

        // 5. Response
        return response()->json([
            'success' => true,
            'message' => 'Resource added succesfully! ',
            'data' => $book
        ], 201);
    }

    public function show(string $id){
        $book = Book::find($id);

        if (!$book){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $book
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. Mencari Data
        $book = Book::find($id);

        if (!$book){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        // 2. Validasi
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
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
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id 
        ];

        // 4. Handle Image
        if ($request->hasFile('cover_photo')){
            $image  = $request->file('cover_photo');
            $image->store('books', 'public');
            
            if ($book->cover_photo){
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            } 

            $data['cover_photo'] = $image->hashName();
        }
        // 5. Update data baru ke database
        $book->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource update successfully',
            'data' => $book
        ], 200);

    }

    public function destroy(string $id){
        $book = Book::find($id);

        if (!$book){
            return response()-> json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        if ($book->cover_photo){
            // delete from storage
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete resource successfully'
        ]);
    }
}
