<?php

namespace Database\Seeders;

use App\Models\Movie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $movies = array();

        array_push(
            $movies,
            $client->request('GET', "http://www.omdbapi.com/?apikey=a9257456&t=dark+knight"),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=la+la+land'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=avatar'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=parasite'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=everything+everywhere+all+at+once'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=oppenheimer'),
        );

        foreach ($movies as $movie) {
            Movie::create([
                'title'       => json_decode((string)$movie->getBody())->Title,
                'image'       => json_decode((string)$movie->getBody())->Poster,
                'description' => json_decode((string)$movie->getBody())->Plot,
                'director'    => json_decode((string)$movie->getBody())->Director,
                'year'        => json_decode((string)$movie->getBody())->Year
            ]);
        }
    }
}
