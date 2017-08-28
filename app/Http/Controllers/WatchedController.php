<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Title;
use App\User;
use App\Seen;
use App\Favorite;

class WatchedController extends Controller
{
    # Gestão de assistidos

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
			return redirect('/home')->with('error', 'Título já havia sido adicionado aos assistidos!');
    	}

    	$seen = Seen::create([
    		'user_id'  => auth()->user()->id,
    		'title_id' => $titulo->id,
    	]);

        return redirect('/home')->with('feedback', 'Adicionado aos assistidos!');
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
}
