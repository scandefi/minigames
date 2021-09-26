<?php

namespace App\Http\Controllers;

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

      return response()->json(['user' => $wallet, 'minigame' => $slug, 'lives' => 99]);
    }

    public function ranking($slug)
    {
      return response()->json(['mnigame' => $slug, 'ranking' => [
        [
          'ranking' => 1,
          'score' => 9999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 2,
          'score' => 8999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 3,
          'score' => 7999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 4,
          'score' => 6999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 5,
          'score' => 5999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 6,
          'score' => 4999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 7,
          'score' => 3999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 8,
          'score' => 2999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 9,
          'score' => 1999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
        [
          'ranking' => 10,
          'score' => 999,
          'wallet' => '0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
          'signature' => 'SIGNATURE0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce',
        ],
      ]]);
    }
}
