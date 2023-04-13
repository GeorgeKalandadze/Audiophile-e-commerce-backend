<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::all();
        $folderPaths = [];
//        for($i = 0; $i < count($products); $i++){
//            $folderPath = "product_images/product-{$products[$i]['slug']}";
//            if (is_dir($folderPath)) {

                for ($j = 0; $j < count($products); $j++) {
                    for ($i = 1; $i < 4; $i++){
                        $newPath = "product_images/product-{$products[$j]['slug']}/image-gallery-{$i}.jpg";
                        DB::table('product_images')->insert([
                            'product_id' => $products[$j]['id'],
                            'path' => $newPath,
                        ]);
                    }



//                }
//
//            }
        }

    }
}


