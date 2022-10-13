<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        return response()->json([
            'status' => true,
            'mesage' => '',
            'data' => Product::query()->get()
        ]);
    }

    public function show(Request $request){
        try {
            $validate = Validator::make($request->all(), [
                'id' => ['required', 'integer', 'min:0'],
            ]);

            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Dữ liệu không hợp lệ.',
                    'error' => $validate->errors()
                ],401);
            }
            $product = Product::find($request->id);

            if (is_null($product)){
                return response()->json([
                    'status' => false,
                    'message' => 'Dữ liệu không hợp lệ.',
                ],400);
            }
            return response()->json([
                'status' => true,
                'message' => '',
                'data' => $product
            ],200);
        }catch (\Throwable $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ],500);
        }
    }
}
