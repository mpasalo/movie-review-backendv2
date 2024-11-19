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
        DB::table('movies')->truncate();
        $client = new Client();

        $movies = array();

        array_push(
            $movies,
            $client->request('GET', "http://www.omdbapi.com/?apikey=a9257456&t=dark_knight"),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=goodfellas'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=127_hours'),
            $client->request('GET', 'http://www.omdbapi.com/?apikey=a9257456&t=wolf_of_wall_street'),
        );

        $id = 1;
        foreach ($movies as $movie) {
            Movie::create([
                'id'          => $id,
                'title'       => json_decode((string)$movie->getBody())->Title,
                'image'       => json_decode((string)$movie->getBody())->Poster,
                'description' => json_decode((string)$movie->getBody())->Plot,
                'director'    => json_decode((string)$movie->getBody())->Director,
            ]);
            $id++;
        }
    }
}
