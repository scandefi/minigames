<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use App\Models\Minigame;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store($wallet, $slug, Request $request)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      $score = Score::create([
        'user_id' => $user->id,
        'minigame_id' => $minigame->id,
        'score' => $request->score,
        'wallet' => $wallet,
        'minigame_name' => $minigame->name,
        'minigame_slug' => $slug,
      ]);

      return response()->json([
        'success' => true,
        'message' => 'Score stored successfully',
        'user' => $wallet,
        'minigame' => $slug,
        'score' => $request->score
      ]);
    }
}
