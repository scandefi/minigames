<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['minigame_id', 'name', 'start_date', 'end_date', 'status', 'minigame_name', 'minigame_slug', 'meta'];

    /* RELALTIONS */

    public function minigame()
    {
        return $this->belongsTo(Minigame::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /* ATTRIBUTES */

    
    /* HELPERS */
}
