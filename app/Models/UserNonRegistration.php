<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNonRegistration extends Model
{
    protected $table = 'users_non_registration';
    public $timestamps = false;

    protected $fillable = ['name', 'surname', 'email'];
}
