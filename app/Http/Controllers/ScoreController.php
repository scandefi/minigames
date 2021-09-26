<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use App\Models\Minigame;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function highscore($wallet, $slug, Request $request)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      $highscore = Score::whereUserId($user->id)->whereMinigameId($minigame->id)->max('score');

      return response()->json([
        'success' => true,
        'message' => 'User '.$wallet.' highscore for ' . $minigame->name . ' minigame',
        'user' => $wallet,
        'minigame' => $slug,
        'score' => $highscore ? $highscore : 0,
      ]);
    }

    public function store($wallet, $slug, Request $request)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

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
        'score' => $request->score,
      ]);
    }
}
