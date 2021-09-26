<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['wallet', 'name', 'email', 'password', 'last_login', 'logged_in', 'ip', 'meta'];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['avatar'];

    protected $casts = ['email_verified_at' => 'datetime', 'last_login' => 'datetime', 'meta' => 'array'];

    /* RELALTIONS */

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /* ATTRIBUTES */

    public function getIpsAttribute()
    {
        return collect($this->meta['ips']);
    }

    public function getAvatarAttribute()
    {
       return 'https://avatars.dicebear.com/api/identicon/'.$this->wallet.'.svg?colorLevel=300';
    }

    /* HELPERS */

    public function storeIp($ip = null)
    {
        $ip = $ip ? $ip : request()->ip();
        $meta = $this->meta;
        $ips = collect($meta['ips'])->push($ip)->unique();
        $meta['ips'] = $ips;
        $this->update(['ip' => $ip, 'meta' => $meta]);
        return true;
    }
}
