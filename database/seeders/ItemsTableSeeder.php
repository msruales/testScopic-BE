<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Item;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images_array = [
            'https://www.goldandtime.org/fotos/1/degrisogono_creation_2.jpg',
            'https://www.publico.es/files/article_main/uploads/2021/10/15/61695730ba7ab.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQv991q2VG1Jbojk1GDvL2Xd8uHHmNg0RfTxg&usqp=CAU',
            'https://cloud10.todocoleccion.online/militaria-armas-fuego/tc/2014/11/13/18/46192250.jpg?size=720x720',
            'https://www.jornada.com.mx/ultimas/2022/01/28/lotes-de-mexico-en-subastas-de-arte-antiguo-en-paris-abren-hoy-4474.html/a03n1cul-1.jpg-2184.html/image_large?bc=2022-01-28T10:03:14-06:00',
            'https://images-cdn.auctionmobility.com/is3/auctionmobility-static/cv2M-1-6NFSK//07402a00.jpg?width=288&height=288&resizeinbox=true&backgroundcolor=EEEEEE',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQskUI0S70n8oV6pqdwBvntkuYxBfGOzDmjEw&usqp=CAU',
            'https://i0.wp.com/redhistoria.com/wp-content/uploads/2017/07/urna-funeraria-griega.jpg?resize=696%2C470&ssl=1',
            'https://images.prismic.io/barnebys/d5ba2139317563ac6d1e8d52c107c2c396113737_casco-corintio-en-bronce.jpg?w=805&auto=format%2Ccompress&cs=tinysrgb',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfEE5KlKbEpm-Cg_PJEcad6kZ_VRhi6mMFmA&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQT3Qt0s_6JHCgCoLyQboRicxE2vX2zCTnBmQ&usqp=CAU',
            'https://suracapulco.mx/wp-content/uploads/2019/06/cabeza_tutankamon_christies_subasta-int-1-1132x670.jpg'
        ];

        $faker = Factory::create();

        for ($i = 0; $i < count($images_array); $i++)
            Item::create([
                'name' => $faker->name,
                'description' => $faker->sentence(10),
                'auction_end' => \Carbon\Carbon::today()->addDays($i),
                'image_url' => $images_array[$i],
            ]);


        for ($i = 1; $i < count($images_array); $i++)
            Auction::create([
                'bid' => $i * 25,
                'user_id' => 3,
                'item_id' => $i,

            ]);

        //bids on items
        for ($i = 1; $i < 4; $i++)
            Auction::create([
                'bid' => $i * 25,
                'user_id' => $i,
                'item_id' => $i,

            ]);
            Auction::create([
            'bid' => 500,
            'user_id' => 3,
            'item_id' => 1,

        ]);
    }
}
