<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductInclude;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductIncludeSeeder extends Seeder
{
    public function run()
    {
        $productIncludes = [
            [
                'product_id' => 1,
                'includes' => [
                    [
                        'quantity' => 2,
                        'item' => 'Earphone unit',
                    ],
                    [
                        'quantity' => 6,
                        'item' => 'Multi-size earplugs',
                    ],
                    [
                        'quantity' => 1,
                        'item' => 'User manual',
                    ],
                    [
                        'quantity' => 1,
                        'item' => 'USB-C charging cable',
                    ],
                    [
                        'quantity' => 1,
                        'item' => 'Travel pouch',
                    ],
                ],
            ],
            [
                'product_id' => 2,
                'includes' => [
                    [
                        "quantity" => 1,
                        "item" => "Headphone unit",
                    ],
                    [
                        "quantity" => 2,
                        "item" => "Replacement earcups",
                    ],
                    [
                        "quantity"=> 1,
                        "item" => "User manual"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],
                ],
            ],
            [
                'product_id' => 3,
                'includes' => [
                    [
                        "quantity" => 1,
                        "item" => "Headphone unit",
                    ],
                    [
                        "quantity" => 2,
                        "item" => "Replacement earcups",
                    ],
                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],
                ],
            ],

            [
                'product_id' => 4,
                'includes' => [
                    [
                        "quantity" => 1,
                        "item" => "Headphone unit",
                    ],
                    [
                        "quantity" => 2,
                        "item" => "Replacement earcups",
                    ],
                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "Travel bag"
                    ],
                ],
            ],

            [
                'product_id' => 5,
                'includes' => [
                    [
                        "quantity" => 2,
                        "item" => "Speaker unit",
                    ],
                    [
                        "quantity" => 2,
                        "item" => "Speaker cloth panel",
                    ],
                    [
                        "quantity"=> 1,
                        "item" => "User manual"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 5m audio cable"
                    ],

                    [
                        "quantity"=> 2,
                        "item" => "7.5m optical cable"
                    ],


                ],
            ],

            [
                'product_id' => 6,
                'includes' => [
                    [
                        "quantity" => 2,
                        "item" => "Speaker unit",
                    ],
                    [
                        "quantity" => 2,
                        "item" => "Speaker cloth panel",
                    ],
                    [
                        "quantity"=> 1,
                        "item" => "User manual"
                    ],

                    [
                        "quantity"=> 1,
                        "item" => "3.5mm 10m audio cable"
                    ],

                    [
                        "quantity"=> 2,
                        "item" => "10m optical cable"
                    ],

                ],
            ],
            // Add more ProductInclude records as needed
        ];

        foreach ($productIncludes as $productInclude) {
            $product = Product::find($productInclude['product_id']);

            foreach ($productInclude['includes'] as $include) {
                $product->productInclude()->create($include);
            }
        }
    }
}
