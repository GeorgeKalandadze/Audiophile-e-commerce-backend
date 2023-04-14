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
            $publicPath = public_path("product_images/");
                for ($i = 0; $i < count($products); $i++) {
                    $folderPath = "{$publicPath}product-{$products[$i]['slug']}";
                    $files = array_diff(scandir($folderPath), array('.', '..'));
                        for ($j = 2; $j < count(scandir($folderPath)); $j++){
                            $pathInfo = pathinfo($files[$j]);
                            $filename = $pathInfo['filename'];
                            $extension = $pathInfo['extension'];
                            $newPath = "product_images/product-{$products[$i]['slug']}/{$filename}.{$extension}";
                            DB::table('product_images')->insert([
                                'product_id' => $products[$i]['id'],
                                'path' => $newPath,
                            ]);
                    }

        }

    }
}


