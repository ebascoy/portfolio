<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = ['poll_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
