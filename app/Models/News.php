<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
