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

    public function roundRanking($slug, $round_name)
    {
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->rounds()->whereName($round_name)->first();
      
      if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      $ranking_total = Score::whereMinigameId($minigame->id)->whereRoundName($round_name)->orderBy('score', 'desc')->get()->groupBy('wallet')->take(30);
      
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
        'round' => $round_name,
        'ranking' => $ranking,
      ]);
    }

    public function activeRoundRanking($slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->activeRound();

        return $this->roundRanking($slug, $round->name);
    }

    public function previousRoundRanking($slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->previousRound();

        return $this->roundRanking($slug, $round->name);
    }
}
