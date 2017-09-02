<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client as Guzzle;
use App\Title;
use App\User;
use App\Seen;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$count = auth()->user()->evaluates()->count();

		if ($count > 50) {
			if ($auth()->user()->curador == 0) {
				$user = auth()->user()->curador = 1;
				$user->save;
			}
		}

        // $http = new Guzzle;

		// #-----------------------------------------------------
		// # Trakt.tv API
		// #-----------------------------------------------------
    	// $response = $http->request('GET', 'https://api.trakt.tv/shows/watched/period', [
    	// 	'headers' => [
	    // 		'trakt-api-version' => '2',
		// 		'Content-Type' 		=> 'application/json',
		// 		'trakt-api-key' 	=> 'd6173f99570add6363262f97df49f21110abb00891c649db9e68a9855b2e735b'
    	// 	]
    	// ]);

		// $data = json_decode((string) $response->getBody(), true);

		// // Adiciona os elementos do response->body em uma array
		// $titulos = [];
		// foreach ($data as $titles => $values) {
		// 	$titulos = array_prepend($titulos, $values);
		// }

		// // Itera sobre a array de títulos e persiste os seus valores
		// foreach ($titulos as $key => $value) {

		// 	$titulo   = ($value['show']['title']);
		// 	$year     = ($value['show']['year']);
		// 	$slug     = ($value['show']['ids']['slug']);
		// 	$trakt_id = ($value['show']['ids']['trakt']);
		// 	$tvdb_id  = ($value['show']['ids']['tvdb']);
		// 	$imdb_id  = ($value['show']['ids']['imdb']);
		// 	$tmdb_id  = ($value['show']['ids']['tmdb']);
		// 	$watcher_count  = ($value['watcher_count']);
		// 	$play_count  = ($value['play_count']);

		// 	$query = $this->getSeriesById ( $trakt_id );

		// 	$overview 		= $query['overview'];
		// 	$network  		= $query['network'];
		// 	$aired_episodes = $query['aired_episodes'];

		// 	#-----------------------------------------------------
		// 	# OMDB API - Brian Fritz
		// 	#-----------------------------------------------------
		// 	$response_omdb = $http->request('GET', 'http://www.omdbapi.com/?i=' . $imdb_id . '&detail=full&apikey=d4ed399');
		// 	$response_omdb_body = json_decode((string)$response_omdb->getBody(), true);

		// 	$poster = $response_omdb_body['Poster'];
		// 	$genre = $response_omdb_body['Genre'];
		// 	$director = $response_omdb_body['Director'];
		// 	$writer = $response_omdb_body['Writer'];
		// 	$actors = $response_omdb_body['Actors'];
		// 	$plot = $response_omdb_body['Plot'];
		// 	$awards = $response_omdb_body['Awards'];
		// 	$imdb_rating = $response_omdb_body['imdbRating'];
		// 	$imdb_votes = $response_omdb_body['imdbVotes'];

		// 	if( (DB::table('titles')->where('trakt', $trakt_id)->count()) === 0 ) {
				
		// 		Title::create([
		// 			'title'  		 => $titulo,
		// 			'year'	 		 => $year,
		// 			'slug'	 		 => $slug,
		// 			'trakt'  		 => $trakt_id,
		// 			'tvdb'	 		 => $tvdb_id,
		// 			'imdb'	 		 => $imdb_id,
		// 			'tmdb'	 		 => $tmdb_id,
		// 			'overview' 		 => $overview,
		// 			'network'  		 => $network,
		// 			'aired_epidodes' => $aired_episodes,
		// 			'poster'		 => $poster,
		// 			'watcher_count'  => $watcher_count,
		// 			'play_count'	 => $play_count,
		// 			'genre'		 	 => $genre,
		// 			'director'		 => $director,
		// 			'writer'		 => $writer,
		// 			'actors'		 => $actors,
		// 			'plot'		 	 => $plot,
		// 			'awards'		 => $awards,
		// 			'imdbRating'	 => $imdb_rating,
		// 			'imdbVotes'		 => $imdb_votes,
		// 		]);

		// 	}

		// }

		$most_watcheds = Title::orderBy('play_count', 'desc')->get();
        $user = Auth::user();
        $subject = 'Títulos mais assistidos';

        $mylist = auth()->user()->titles;

		return view('home', compact('most_watcheds', 'user', 'subject',  'mylist'));
    }

    /**
	 * Consulta os títulos por id
	 *
	 * Padrão: Informações full
	 */
    public function getSeriesById ($id)
    {
    	$http = new Guzzle;

    	$response = $http->request('GET', 'https://api.trakt.tv/shows/' . $id . '?extended=full', [
    		'headers' => [
	    		'trakt-api-version' => '2',
				'Content-Type' 		=> 'application/json',
				'trakt-api-key' 	=> 'd6173f99570add6363262f97df49f21110abb00891c649db9e68a9855b2e735b'
    		]
    	]);

	    return json_decode((string) $response->getBody(), true);
    }
}
