<?php

namespace admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUsers extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table= "users";
    protected $guard= [];
    //protected $fillable  = ['name','image','image_path','email','about','password','address','age','phoneNumber','region','zipCode','recognitionSign'];

      
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
