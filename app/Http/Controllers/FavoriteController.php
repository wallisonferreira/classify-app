<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Title;
use App\User;
use App\Seen;
use App\Favorite;

class FavoriteController extends Controller
{
    # Gestão de favoritos

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

		return redirect('/favoritos')->with('feedback', 'removido!');
    }
}
