<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'minigame_id', 'score', 'round_id', 'round_name', 'start_game', 'end_game', 'duration', 'wallet', 'minigame_name', 'minigame_slug', 'meta'];

    protected $casts = ['meta' => 'array', 'start_game' => 'datetime', 'end_game' => 'datetime'];

    /* RELALTIONS */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function minigame()
    {
        return $this->belongsTo(Minigame::class);
    }
    
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    /* ATTRIBUTES */

    /* HELPERS */
}
