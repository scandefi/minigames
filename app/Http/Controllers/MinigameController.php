<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Minigame;
use Illuminate\Http\Request;

class MinigameController extends Controller
{
    public function play($slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        if(!$minigame) abort(404);

        return view('minigames.play')->withMinigame($minigame);
    }

    public function lives($wallet, $slug)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json(['user' => $wallet, 'minigame' => $slug, 'lives' => 99999]);
    }

    public function ranking($slug)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      
      if(!$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);
      
      $ranking_total = Score::whereMinigameId($minigame->id)->orderBy('score', 'desc')->get()->groupBy('wallet')->take(30);
      
      $ranking = collect();
      $index = 1;
      foreach($ranking_total as $wallet => $scores):
        $ranking->push([
          'ranking' => $index,
          'score' => $scores[0]->score,
          'wallet' => $wallet,
          'signature' => $wallet,
        ]);

        $index++;
      endforeach;

      return response()->json([
        'success' => true,
        'message' => 'Ranking for ' . $minigame->name . ' minigame',
        'mnigame' => $slug,
        'ranking' => $ranking,
      ]);
    }

    public function roundRanking($slug, $round_id)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->rounds()->find($round_id);
      
      if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      $ranking_total = Score::whereMinigameId($minigame->id)->whereRoundId($round_id)->orderBy('score', 'desc')->get()->groupBy('wallet')->take(30);
      
      $ranking = collect();
      $index = 1;
      foreach($ranking_total as $wallet => $scores):
        $ranking->push([
          'ranking' => $index,
          'score' => $scores[0]->score,
          'wallet' => $wallet,
          'signature' => $wallet,
        ]);

        $index++;
      endforeach;

      return response()->json([
        'success' => true,
        'message' => 'Ranking for ' . $minigame->name . ' minigame Round ' . $round->name,
        'mnigame' => $slug,
        'round' => $round->name,
        'ranking' => $ranking,
      ]);
    }

    public function activeRoundRanking($slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->activeRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundRanking($slug, $round->id);
    }

    public function previousRoundRanking($slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->previousRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundRanking($slug, $round->id);
    }

    public function rounds($slug)
    {
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json([
        'success' => true,
        'message' => 'Rounds of ' . $minigame->name . ' minigame',
        'mnigame' => $slug,
        'rounds' => $minigame->rounds,
      ]);
    }

    public function activeRound($slug)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->activeRound();

      if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json([
        'success' => true,
        'message' => 'Active round of ' . $minigame->name . ' minigame',
        'mnigame' => $slug,
        'round' => $round,
      ]);
    }

    public function previousRound($slug)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->previousRound();

      if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json([
        'success' => true,
        'message' => 'Previous round of ' . $minigame->name . ' minigame',
        'mnigame' => $slug,
        'round' => $round,
      ]);
    }

    public function nextRound($slug)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->nextRound();

      if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json([
        'success' => true,
        'message' => 'Next round of ' . $minigame->name . ' minigame',
        'mnigame' => $slug,
        'round' => $round,
      ]);
    }
}
