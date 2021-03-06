<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use App\Models\Minigame;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
      $user = User::create(['wallet' => $request->wallet, 'ip' => request()->ip()]);
      $user->storeIp(request()->ip());

      return response()->json(['success' => true, 'user' => $user, 'request' => $request->all()]);
    }

    public function loginOrRegister(Request $request)
    {
      if(auth()->check()):
        self::logout($request);
      endif;
      
      $user = User::whereWallet($request->wallet)->first();

      if(!$user) $user = User::create(['wallet' => $request->wallet, 'ip' => request()->ip()]);

      // $user->tokens()->delete();
      // $token = $user->createToken('minigames')->plainTextToken;

      auth()->login($user);
      $user->storeIp(request()->ip());
      $user->update(['logged_in' => true, 'last_login' => now()]);

      return response()->json(['success' => true, 'message' => 'User logged in successfully', 'user' => $user]);
    }

    public function logout(Request $request)
    {
      if(auth()->check()):
        $authuser = auth()->user();
        $authuser->update(['logged_in' => false]);
        auth()->logout();
      endif;

      return response()->json(['success' => true, 'message' => 'User logged out successfully', 'user' => null]);
    }

    public function lives($wallet, $slug)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      return response()->json(['user' => $wallet, 'minigame' => $slug, 'lives' => 9999]);
    }

    public function ranking($wallet, $slug)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();

      if(!$user || !$minigame) return response()->json(['success' => false, 'message' => 'Model not found']);

      $ranking_total = Score::whereMinigameId($minigame->id)->orderBy('score', 'desc')->get()->groupBy('wallet');
      
      $total = $ranking_total->count();
      $wallets = collect(array_keys($ranking_total->toArray()));

      $ranking = $wallets->search(function($wallet) use($user) {
        return $wallet === $user->wallet;
      });

      $ranking = $ranking + 1;

      return response()->json([
        'success' => true,
        'message' => 'User ' . $wallet . ' ranking for ' . $minigame->name . ' minigame',
        'user' => $wallet,
        'minigame' => $slug,
        'ranking' => $ranking,
        'score' => $ranking_total[$wallet][0]['score'],
        'total' => $total,
      ]);
    }

    public function roundRanking($wallet, $slug, $round_id)
    {
      $user = User::whereWallet($wallet)->first();
      $minigame = Minigame::whereSlug($slug)->first();
      $round = $minigame->rounds()->find($round_id);

      if(!$user || !$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

      $ranking_total = Score::whereMinigameId($minigame->id)->whereRoundId($round_id)->orderBy('score', 'desc')->get()->groupBy('wallet');
      
      $total = $ranking_total->count();
      $wallets = collect(array_keys($ranking_total->toArray()));

      $ranking = $wallets->search(function($wallet) use($user) {
        return $wallet === $user->wallet;
      });

      $ranking = $ranking + 1;

      return response()->json([
        'success' => true,
        'message' => 'User ' . $wallet . ' ranking for ' . $minigame->name . ' minigame Round ' . $round->name,
        'user' => $wallet,
        'minigame' => $slug,
        'round' => $round->name,
        'ranking' => $ranking,
        'score' => $ranking_total[$wallet][0]['score'],
        'total' => $total,
      ]);
    }

    public function activeRoundRanking($wallet, $slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->activeRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundRanking($wallet, $slug, $round->id);
    }

    public function previousRoundRanking($wallet, $slug)
    {
        $minigame = Minigame::whereSlug($slug)->first();
        $round = $minigame->previousRound();

        if(!$minigame || !$round) return response()->json(['success' => false, 'message' => 'Model not found']);

        return $this->roundRanking($wallet, $slug, $round->id);
    }
}
