<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendships extends Model
{
  protected $fillable = [
      'requestor', 'user_requested', 'status',
  ];
}
