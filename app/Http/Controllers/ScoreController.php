<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Round;
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

    public function roundHighscore($wallet, $slug, $round_id)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->rounds()->find($round_id);

      if(!$user || !$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      $highscore = Score::whereUserId($user->id)->whereMinigameId($minigame->id)->whereRoundId($round_id)->max('score');

      return response()->json([
        'success' => true,
        'message' => 'User '.$wallet.' highscore for ' . $minigame->name . ' minigame Round ' . $round->name,
        'user' => $wallet,
        'minigame' => $slug,
        'score' => $highscore ? $highscore : 0,
        'round' => $round->name,
      ]);
    }

    public function activeRoundHighscore($wallet, $slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->activeRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundHighscore($wallet, $slug, $round->id);
    }

    public function previousRoundHighscore($wallet, $slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->previousRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundHighscore($wallet, $slug, $round->id);
    }

    public function store($wallet, $slug, Request $request)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();


      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      $start_game = Carbon::createFromFormat('m/d/Y h:i:s A', $request->start_game)->toDateTimeString();
      $end_game = Carbon::createFromFormat('m/d/Y h:i:s A', $request->end_game)->toDateTimeString();
      // dd($request->start_game, $start_game);

      $round = $minigame->activeRound();

      $score = Score::create([
        'user_id' => $user->id,
        'minigame_id' => $minigame->id,
        'score' => $request->score,
        'round_id' => $round->id,
        'round_name' => $round->name,
        'wallet' => $wallet,
        'start_game' => $start_game,
        'end_game' => $end_game,
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
