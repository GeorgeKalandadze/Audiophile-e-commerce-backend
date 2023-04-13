<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function index(){
        $images = ProductImage::all();

        return response()->json($images);
    }
}
