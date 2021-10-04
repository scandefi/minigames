<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Minigame extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'meta'];

    protected $casts = ['meta' => 'array'];

    /* RELALTIONS */

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function activeRound()
    {
        return $this->rounds()->whereStatus('active')->first();
    }

    public function nextRound()
    {
        return $this->rounds()->whereStatus('waiting')->first();
    }

    public function previousRound()
    {
        return $this->rounds()->whereStatus('ended')->latest()->first();
    }
}
