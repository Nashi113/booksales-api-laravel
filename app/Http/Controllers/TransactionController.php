<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('user', 'book')->get();

        if  ($transaction->isEmpty()){
            return response()->json([
                "succes"=> true,
                "message"=> "Resource data not Found!"
            ]);
        }

        return response()-> json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $transaction
        ], 200);
    }

    public function show(string $id){
        $transaction = Transaction::with('user', 'book')->find($id);

        if  (!$transaction){
            return response()->json([
                "succes"=> true,
                "message"=> "Resource data not Found!"
            ]);
        }

        return response()-> json([
            "succes" => true,
            "message" => "Get detail Resources",
            "data" => $transaction
        ], 200);
    }

    public function store(Request $request){
        // 1.Validator
        $validator = Validator::make($request->all(),[
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
       }

       // 2. Generetae order number -> unique | ORD-0234124
       $uniqueCode = "ORD-" . strtoupper(uniqid());

       // 3. User harus Login & cek login apakah user ada ?
       $user = auth('api')->user();

       if(!$user){
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized!'
        ], 401);
       }

       // 4. mencari buku dari request
       $book = Book::find($request->book_id);

       // 5. cek stok buku
       if ($book->stock < $request->quantity) {
        return response()->json([
            'success' => false,
            'message' => 'Stok Barang tidak cukup!'
        ], 400);
       }

       // 6. Hitung total harga
       $totalAmount = $book->price * $request->quantity;

       // 7. kurangi stok buku
       $book->stock -= $request->quantity;
       $book->save();

       // 8. simpan data transaksi
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transactions
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $user = auth('api')->user();
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        // Customer hanya bisa update transaksi miliknya
        if ($user->role === 'customer' && $transaction->customer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this transaction.'
            ], 403);
        }

        // Validasi
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::find($transaction->book_id);
        $difference = $request->quantity - ($transaction->quantity ?? 1);

        // Jika quantity naik, pastikan stok cukup
        if ($difference > 0 && $book->stock < $difference) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not sufficient for update.'
            ], 400);
        }

        // Update stok & total
        $book->stock -= $difference;
        $book->save();

        $transaction->update([
            'quantity' => $request->quantity,
            'total_amount' => $book->price * $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully.',
            'data' => $transaction
        ], 200);
    }

    public function destroy($id)
    {
        // 1. User harus Login
        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        // 2. Cari transaksi
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found!'
            ], 404);
        }

        // 3. Ambil buku
        $book = Book::find($transaction->book_id);

        // 4. Hitung quantity
        $quantity = $transaction->total_amount / $book->price;

        // 5. Kembalikan stok
        $book->stock += $quantity;
        $book->save();

        // 6. Hapus transaksi
        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }



}
