<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'minigame_id', 'score', 'wallet', 'minigame_name', 'minigame_slug', 'meta'];

    protected $casts = ['meta' => 'array'];

    /* RELALTIONS */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function minigame()
    {
        return $this->belongsTo(Minigame::class);
    }

    /* ATTRIBUTES */

    /* HELPERS */
}
