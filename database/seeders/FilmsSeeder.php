<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'release_date' => '1994-09-23',
                'rating' => 9.3,
                'image' => 'https://resizing.flixster.com/StPZgrWLsXXnJQ7OMaPltNzzsaw=/300x300/v2/https://flxt.tmsimg.com/assets/p15987_p_v8_ai.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'release_date' => '1972-03-24',
                'rating' => 9.2,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5pRS0GODUnh6MrK1BQSqr6weH2KOajrbMKA&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Forrest Gump',
                'description' => 'The presidencies of Kennedy and Johnson, the events of Vietnam, Watergate and other historical events unfold through the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.',
                'release_date' => '1994-07-06',
                'rating' => 8.8,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8oqBzPiTKxjktJe1pAuiBVpLKTwavMDzRrQ&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_date' => '2008-07-18',
                'rating' => 9.0,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfrcJw4t5stnKHSst8aZcMf2QiKrWjh-Y06w&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'release_date' => '1994-09-10',
                'rating' => 8.9,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbOGQPGNrtHoyaIH817hq82FfYS7bhj6DGwQ&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'description' => 'A meek hobbit of The Shire and eight companions set out on a journey to Mount Doom to destroy the One Ring and the dark lord Sauron.',
                'release_date' => '2001-12-19',
                'rating' => 8.8,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHV814-1yCbT3Nn0IoZo8RusZsllBdHj45MA&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Matrix',
                'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'release_date' => '1999-03-31',
                'rating' => 8.7,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSAlnQsbSV0NM2A_dmY9A16Uz6PR4ObPzJ1A&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Schindler\'s List',
                'description' => 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.',
                'release_date' => '1993-11-30',
                'rating' => 8.9,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmWegeF6ViqLEG_6zV4nZmJ_N2qJCYrOi7eA&usqp=CAU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

