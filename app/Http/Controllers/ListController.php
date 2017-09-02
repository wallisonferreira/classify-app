<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Title;
use App\User;
use App\Seen;
use App\Favorite;

class ListController extends Controller
{
    # Gestão de lista pessoal

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

			return redirect()->back()->with('error', 'Título já havia sido adicionado!');
    	}

    	$titulo->users()->attach([auth()->user()->id]);

        $watcheds = Title::orderBy('play_count', 'desc')->get();
        $user = Auth::user();
        $subject = 'Títulos mais assistidos';

		return redirect()->back()->with('feedback', 'adicionado à lista');
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
}
