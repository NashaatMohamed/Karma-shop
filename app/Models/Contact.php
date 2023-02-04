<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ["name","email","subject","message"];

    public static function boot() {

        parent::boot();

        static::created(function ($item) {

            $adminEmail = "nashaat.mohamed.969@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }

}
