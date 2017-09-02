<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use GuzzleHttp\Client as Guzzle;
use App\Title;
use App\User;
use App\Seen;
use App\Favorite;
use App\Comment;
use Search;

class TitleController extends Controller
{
	public function getTitle ($id)
    {
    	$title = Title::where('id', $id)->with(['comments' => function ($query) {
			$query->orderBy('created_at', 'desc');
		}])->first();

		$user = Auth::user();

    	return view('title', compact('title', 'subject', 'user'));
    }

	public function getSearch(Request $request)
	{
		$title = $request->input('titleName');
		$most_watcheds = Title::search($title)->get();

		$user = Auth::user();
        $subject = 'Resultado da busca: ' . $title;

		return view('home', compact('most_watcheds', 'user', 'subject'));
	}

	public function addComment(Request $request, $titulo)
	{
		$comment = Comment::create([
			'user_id'  => auth()->user()->id,
			'title_id' => $titulo,
			'texto'	   => $request->input('texto'),
		]);

		// return redirect('/ver/titulo/' . $titulo)->with('feedback', [
		// 	'agradecimento' => 'Obrigado por comentar',
		// 	'continue'		=> 'Sua opinião é muito importante!'
		// ]);
		return redirect('/ver/titulo/' . $titulo)->with('comment', 'Obrigado por comentar. Sua opinião é muito importante');
	}

	public function removeComment(Comment $comment, $user, $titulo)
	{
		if(auth::user()->id == $user) {
			$comment->delete();
		}

		return redirect('/ver/titulo/' . $titulo);
	}

    public function getList ()
    {
    	$mylist = auth()->user()->titles;
        $user = auth()->user();
        $subject = 'Lista Pessoal';

    	return view('list', compact('mylist', 'user', 'subject'));
    }

    public function addToList (Title $titulo)
    {
    	$haveInList = ( DB::table('lists')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

    	if ($haveInList >= 1) {
			return redirect('/home')->with('error', 'Título já havia sido adicionado!');
    	}

    	$titulo->users()->attach([auth()->user()->id]);

        $watcheds = Title::orderBy('watched', 'desc')->get();
        $user = Auth::user();
        $subject = 'Títulos mais assistidos';

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
        $subject = 'Lista Pessoal';

    	return view('list', compact('mylist', 'user', 'subject'));
    }

	# Gerencia de Favoritos

	public function getFavorite ()
    {
    	$myfavorites = auth()->user()->favorites;
        $user = auth()->user();
        $subject = 'Favoritos';

    	return view('favorites', compact('myfavorites', 'user', 'subject'));
    }

    public function addToFavorite (Title $titulo)
    {
    	$haveInFavorites = ( DB::table('favorites')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

    	if ($haveInFavorites >= 1) {
			return redirect('/home')->with('error', 'Título já havia sido adicionado aos favoritos!');
    	}

    	$favorite = Favorite::create([
    		'user_id'  => auth()->user()->id,
    		'title_id' => $titulo->id,
    	]);

        $watcheds = Title::orderBy('watched', 'desc')->get();
        $user = Auth::user();
        $subject = 'Favoritos';

		return redirect('/home')->with('feedback', 'adicionado aos favoritos');
    }

    public function removeFromFavorite (Title $titulo)
    {
		$haveInFavorites = ( DB::table('favorites')
			->where('title_id', $titulo->id)
			->where('user_id', auth()->user()->id)
			->count() );

		if ($haveInFavorites >= 1) {
			$haveInFavorites = ( DB::table('favorites')
				->where('title_id', $titulo->id)
				->where('user_id', auth()->user()->id)
				->delete()
			);
		}


		$mylist = auth()->user()->titles;
        $user = auth()->user();
        $subject = 'Favoritos';

		return redirect('/favorites')->with('feedback', 'removido!');
    }

	# Gerencia de Assistidos

	public function getWatched ()
	{
		$myseens = auth()->user()->seens;
        $user = auth()->user();
        $subject = 'Assistidos';

    	return view('watcheds', compact('myseens', 'user', 'subject'));
	}

    public function getSeriesFromWatched ()
    {
    	$myWatched = auth()->user()->seens;

    	return response()->json($myWatched, 200);
    }

}
