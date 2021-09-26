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
        return view('minigames.play')->withMinigame($minigame);
    }

    public function lives($wallet, $slug)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

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
        'ranking' => $ranking
      ]);
    }
}
