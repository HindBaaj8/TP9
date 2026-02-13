<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participants');}

    public function speakers(){
        return $this->belongsToMany(Speaker::class, 'event_speakers');
    }
    public function user(){
    return $this->belongsTo(User::class);
    }

}
