<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class UserMessage extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = 'user_messages';
    protected $with = ['message'];

    protected $sortParameterName = 'sort';

    public $sortable = ['receiver_id', 'created_at'];

    protected $searchable = ['search_txt', 'receiver_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('receiver_id', $constraint->getOperator(), $constraint->getValue());
                // ->orWhere('receiver_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($userMessage) {
            $userMessage->sender_id = Auth::user()->id;
        });
    }

    public static function addUpdate($userMessage, $request)
    {

        // For Message update.
        if ($userMessage->message) {
            $message = Message::addUpdate($userMessage->message, $request);
        } else {
            $message = Message::addUpdate(new Message, $request);
        }

        if (isset($request->client_id)) {
            $userMessage->client_id = $request->client_id;
        }

        if (isset($request->receiver_id)) {
            $userMessage->receiver_id = null;
            if (!is_null($request->receiver_id)) {
                $userMessage->receiver_id = $request->receiver_id;
            }
        }

        if (isset($request->falg_read)) {
            $userMessage->falg_read = $request->falg_read;
        }

        $userMessage->message_id = $message->id;

        $userMessage->save();

        return $userMessage;
    }

    public function sender()
    {
        return $this->belongsTo(user::class, 'sender_id');
    }

    // A message also belongs to a receiver    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function Message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
