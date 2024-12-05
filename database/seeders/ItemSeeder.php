<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'id'=>Str::uuid(),
                'name'=>'Hainanese Chicken Rice',
                'description'=>'Nasi gurih yang dimasak dengan kaldu ayam, disajikan bersama ayam rebus lembut, saus jahe, dan sambal',
                'price'=>35000.00,
                'category'=>'Rice',
                'image'=>'items/rice/rice-1.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Nasi Lemak',
                'description'=>'Nasi yang dimasak dengan santan dan daun pandan, disajikan dengan sambal, ikan bilis, telur, dan pelengkap lainnya',
                'price'=>30000.00,
                'category'=>'Rice',
                'image'=>'items/rice/rice-2.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Chicken Chop Curry Rice',
                'description'=>'Ayam fillet goreng tepung yang renyah disajikan dengan nasi putih hangat dan siraman kuah kari kental yang gurih',
                'price'=>35000.00,
                'category'=>'Rice',
                'image'=>'items/rice/rice-3.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Singapore Laksa',
                'description'=>'Mi berkuah santan pedas yang kaya rempah, dilengkapi dengan udang, fish cake, kerang, dan daun ketumbar',
                'price'=>32000.00,
                'category'=>'Noodle',
                'image'=>'items/noodle/noodle-1.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Char Kway Teow',
                'description'=>'Mi beras lebar yang digoreng dengan udang, kerang, telur, dan tauge, diberi bumbu kecap manis dan rempah, menciptakan rasa gurih dan sedikit pedas',
                'price'=>28000.00,
                'category'=>'Noodle',
                'image'=>'items/noodle/noodle-2.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Traditional Kaya Toast',
                'description'=>'Roti panggang yang diisi dengan kaya (selai kelapa manis) dan mentega, disajikan dengan telur setengah matang',
                'price'=>24000.00,
                'category'=>'Snack',
                'image'=>'items/snack/snack-1.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Melted Cheese Toast with Scrambled Egg',
                'description'=>'Roti panggang dengan keju leleh gurih, dilengkapi telur orak-arik lembut',
                'price'=>24000.00,
                'category'=>'Snack',
                'image'=>'items/snack/snack-2.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Butter Sugar Toast',
                'description'=>'Roti panggang dengan olesan mentega dan taburan gula',
                'price'=>20000.00,
                'category'=>'Snack',
                'image'=>'items/snack/snack-3.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Kopi C',
                'description'=>'Kopi khas Asia yang disajikan tanpa susu, dibuat dengan kopi yang diseduh kental dan dicampur dengan gula, memberikan rasa kopi yang kuat dan sedikit manis',
                'price'=>12000.00,
                'category'=>'Coffee',
                'image'=>'items/coffee/coffee-1.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Kopi Tarik',
                'description'=>'Kopi khas Malaysia dan Singapura yang dibuat dengan mencampurkan kopi dan susu kental manis, kemudian "ditarik" secara berulang untuk menciptakan lapisan busa yang halus dan rasa yang kaya',
                'price'=>15000.00,
                'category'=>'Coffee',
                'image'=>'items/coffee/coffee-3.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Teh Tarik',
                'description'=>'Teh susu khas Malaysia yang "ditarik" untuk menciptakan busa halus dan rasa yang kaya',
                'price'=>12000.00,
                'category'=>'Non-coffee',
                'image'=>'items/non-coffee/non-coffee-1.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Milo Ais',
                'description'=>'Minuman dingin berbasis bubuk Milo yang dicampur dengan susu manis dan es, menciptakan rasa cokelat yang kaya dan segar',
                'price'=>14000.00,
                'category'=>'Non-coffee',
                'image'=>'items/non-coffee/non-coffee-3.jpg',
                'availability'=>true
            ],
            [
                'id'=>Str::uuid(),
                'name'=>'Mineral Water',
                'description'=>'Air mineral alami yang mengandung mineral dan elemen penting, memberikan rasa segar dan manfaat kesehatan',
                'price'=>5000.00,
                'category'=>'Non-coffee',
                'image'=>'items/non-coffee/non-coffee-3.jpg',
                'availability'=>true
            ],
        ]);
    }
}
