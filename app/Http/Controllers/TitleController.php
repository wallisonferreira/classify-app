<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client as Guzzle;
use App\Title;
use App\User;
use App\Seen;

class TitleController extends Controller
{
    public function titleMostWatched ()
    {
    	// $http = new Guzzle;

    	// $response = $http->request('GET', 'https://api.trakt.tv/shows/watched/period', [
    	// 	'headers' => [
	    // 		'trakt-api-version' => '2',
		// 		'Content-Type' 		=> 'application/json',
		// 		'trakt-api-key' 	=> 'd6173f99570add6363262f97df49f21110abb00891c649db9e68a9855b2e735b'
    	// 	]
    	// ]);

		// $data = json_decode((string) $response->getBody(), true);

		// Adiciona os elementos do response->body em uma array
		
		// $titulos = [];
		// foreach ($data as $titles => $values) {
		// 	$titulos = array_prepend($titulos, $values);
		// }

		// Itera sobre a array de títulos e persiste os seus valores
		// foreach ($titulos as $key => $value) {

		// 	$titulo   = ($value['show']['title']);
		// 	$year     = ($value['show']['year']);
		// 	$slug     = ($value['show']['ids']['slug']);
		// 	$trakt_id = ($value['show']['ids']['trakt']);
		// 	$tvdb_id  = ($value['show']['ids']['tvdb']);
		// 	$imdb_id  = ($value['show']['ids']['imdb']);
		// 	$tmdb_id  = ($value['show']['ids']['tmdb']);
		// 	$watched  = ($value['watcher_count']);

		// 	$query = $this->getSeriesById ( $trakt_id );

		// 	$overview 		= $query['overview'];
		// 	$network  		= $query['network'];
		// 	$aired_episodes = $query['aired_episodes'];

		// 	$response_poster = $http->request('GET', 'http://www.omdbapi.com/?i=' . $imdb_id . '&detail=full');
		// 	$response_poster_body = json_decode((string)$response_poster->getBody(), true);

		// 	$poster = $response_poster_body['Poster'];

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
		// 			'watched'		 => $watched,
		// 		]);

		// 	}

		// }

		$watcheds = Title::orderBy('watched', 'desc')->get();
        $user = $auth->user;

        $mylist = auth()->user()->titles;

		return view('home', compact('watcheds', 'user', 'mylist'));
	}

    public function getList ()
    {
    	$mylist = auth()->user()->titles;
        $user = auth()->user();
        $subject = 'Favoritos';

    	return view('favorites', compact('mylist', 'user', 'subject'));
    }

    public function addToList (Title $titulo)
    {
    	$haveInList = ( DB::table('lists')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

    	if ($haveInList >= 1) {
    		// return response()->json(" Título já havia sido adicionado! ", 300);
			return redirect('/home')->with('error', 'Título já havia sido adicionado!');
    	}

    	$titulo->users()->attach([auth()->user()->id]);

        $watcheds = Title::orderBy('watched', 'desc')->get();
        $user = Auth::user();
        $subject = 'Títulos mais assistidos';

        //dd($watcheds);
		// $request = new Request;
		// $request->session()->flash('feedback', 'Título adicionado!');

		// return view('home', compact('watcheds', 'user', 'subject'));
		return redirect('/home')->with('feedback', 'adicionado à lista');
    }

    public function removeFromList (Title $titulo)
    {
		$haveInList = ( DB::table('lists')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

		if ($haveInList >= 1) {
			$titulo->users()->detach([auth()->user()->id]);
		}

		$mylist = auth()->user()->titles;
        $user = auth()->user();
        $subject = 'Favoritos';

    	return view('favorites', compact('mylist', 'user', 'subject'));
    }

	public function getWatched ()
	{
		$myseens = auth()->user()->seens;
        $user = auth()->user();
        $subject = 'Assistidos';

    	return view('watcheds', compact('myseens', 'user', 'subject'));
	}

    public function addToWatched (Title $titulo)
    {
    	$haveInList = ( DB::table('seens')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

    	if ($haveInList >= 1) {

    		// return response()->json(" Título já havia sido adicionado aos assistidos! ", 300);
			return redirect('/favoritos')->with('error', 'Título já havia sido adicionado aos assistidos!');
    	}

    	$seen = Seen::create([
    		'user_id'  => auth()->user()->id,
    		'title_id' => $titulo->id,
    	]);

    	// $titulo->users()->attach([auth()->user()->id]);

        return redirect('/favoritos')->with('feedback', 'Adicionado aos assistidos!');
    }

    public function removeFromWatched (Title $titulo)
    {
		$haveInList = ( DB::table('seens')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() 
		);

		if ($haveInList >= 1) {
			$haveInList = ( DB::table('seens')
				->where('title_id', $titulo->id)
				->where('user_id', auth()->user()->id)
				->delete()
			);
		}

		return redirect('/assistidos')->with('feedback', 'removido!');
    }

    public function getSeriesFromWatched ()
    {
    	$myWatched = auth()->user()->seens;

    	return response()->json($myWatched, 200);
    }

    public function getTitle ($id)
    {
    	$title = Title::where('id', $id)->get();

    	return response()->json($title, 200);
    }

    /**
	 * Consulta os títulos por nome, slug ou id
	 *
	 * Padrão: Informações short
	 */
	public function getSeriesbyName ($name)
	{
		$http = new Guzzle;

    	$response = $http->request('GET', 'https://api.trakt.tv/search/show?query=' . $name, [
    		'headers' => [
	    		'trakt-api-version' => '2',
				'Content-Type' 		=> 'application/json',
				'trakt-api-key' 	=> 'd6173f99570add6363262f97df49f21110abb00891c649db9e68a9855b2e735b'
    		]
    	]);

		$data = json_decode((string) $response->getBody(), true);

		// Adiciona os elementos do response->body em uma array
		$titulos = [];
		foreach ($data as $titles => $values) {
			$titulos = array_prepend($titulos, $values);
		}

		// Itera sobre a array de títulos e persiste os seus valores
		foreach ($titulos as $key => $value) {

			$titulo   = ($value['show']['title']);
			$year     = ($value['show']['year']);
			$slug     = ($value['show']['ids']['slug']);
			$trakt_id = ($value['show']['ids']['trakt']);
			$tvdb_id  = (isset($value['show']['ids']['tvdb']) ? $value['show']['ids']['tvdb'] : null);
			$imdb_id  = (isset($value['show']['ids']['imdb']) ? $value['show']['ids']['imdb'] : null);
			$tmdb_id  = (isset($value['show']['ids']['tmdb']) ? $value['show']['ids']['tmdb'] : null);
			$watched  = (isset($value['watcher_count']) ? $value['watcher_count'] : null);

			$query = $this->getSeriesById ( $trakt_id );

			$overview 		= (isset($query['overview']) ? $query['overview'] : null);
			$network  		= (isset($query['network']) ? $query['network'] : null);
			$aired_episodes = (isset($query['aired_episodes']) ? $query['aired_episodes'] : null);

			$response_poster = $http->request('GET', 'http://www.omdbapi.com/?i=' . $imdb_id . '&detail=full');
			$response_poster_body = json_decode((string)$response_poster->getBody(), true);

			$poster = (isset($response_poster_body['Poster']) ? $response_poster_body['Poster'] : null);

			if( (DB::table('titles')->where('trakt', $trakt_id)->count()) === 0 ) {
				
				Title::create([
					'title'  		 => $titulo,
					'year'	 		 => $year,
					'slug'	 		 => $slug,
					'trakt'  		 => $trakt_id,
					'tvdb'	 		 => $tvdb_id,
					'imdb'	 		 => $imdb_id,
					'tmdb'	 		 => $tmdb_id,
					'overview' 		 => $overview,
					'network'  		 => $network,
					'aired_epidodes' => $aired_episodes,
					'poster'		 => $poster,
					'watched'		 => $watched,
				]);

			}

		}

		$query_name = Title::where('title', 'like', '%' . $name . '%')->get();

		return response()->json($query_name, 200);
	}


}
