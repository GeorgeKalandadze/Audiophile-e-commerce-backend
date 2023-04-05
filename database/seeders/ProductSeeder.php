<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table('categories')->insert([
            [
                "slug" => "yx1-earphones",
                "name" => "YX1 Wireless Earphones",
                "category_id" => 1,
                "price" => 599,
                "description" => "Tailor your listening experience with bespoke dynamic drivers
                                  from the new YX1 Wireless Earphones. Enjoy incredible high-fidelity
                                  sound even in noisy environments with its active noise cancellation feature.",
                "features" => "Experience unrivalled stereo sound thanks to innovative acoustic technology.
                               With improved ergonomics designed for full day wearing, these revolutionary
                               earphones have been finely crafted to provide you with the perfect fit,
                               delivering complete comfort all day long while enjoying exceptional noise
                               isolation and truly immersive sound.\n\nThe YX1 Wireless Earphones features
                               customizable controls for volume, music, calls, and voice assistants built
                               into both earbuds. The new 7-hour battery life can be extended up to 28 hours
                               with the charging case, giving you uninterrupted play time. Exquisite craftsmanship
                               with a splash resistant design now available in an all new white and grey color
                               scheme as well as the popular classic black.",
                "new" => boolval(1)
            ],

        ]);
    }
}
