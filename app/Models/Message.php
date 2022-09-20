<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Message extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "messages";

    public static function addUpdate($message, $request)
    {

        if (isset($request->message)) {
            $message->message = $request->message;
        }

        $message->save();
        return $message;
    }
}
