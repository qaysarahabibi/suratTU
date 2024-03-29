<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{

    protected $guarded = ['id'];


    use HasFactory;

    public function letterType(){
        return $this->belongsTo(LetterType::class, 'letter_type_id');
    }
    // Relasi dengan notulis (data dari guru)
    public function notulis()
    {
        return $this->belongsTo(LetterType::class, 'notulis');
    }

    public function notulisUser()
    {
        return $this->belongsTo(User::class, 'notulis', 'id');
    }


    public function letters()
    {
        return $this->hasMany(Letter::class, 'letter_type_id');
    }

    public function getLetterCountAttribute()
    {
        return $this->letters->count();
    }

}