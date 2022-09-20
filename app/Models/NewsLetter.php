<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class NewsLetter extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "news_letters";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'email', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'email', 'name', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('name', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('email', $constraint->getOperator(), $constraint->getValue());
                //->orWhere('status', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($newsLetter) {
            $newsLetter->created_by = Auth::user()->id;
        });

        self::created(function ($newsLetter) {
            // ... code here
        });

        self::updating(function ($newsLetter) {
            $newsLetter->updated_by = Auth::user()->id;
        });

        self::updated(function ($newsLetter) {
            // ... code here
        });

        self::deleting(function ($newsLetter) {
            $newsLetter->deleted_by = Auth::user()->id;
            $newsLetter->save();
        });

        self::deleted(function ($newsLetter) {
        });
    }

    public static function addUpdate($newsLetter, $request)
    {

        if (isset($request->client_id)) {
            $newsLetter->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $newsLetter->name = $request->name;
        }

        if (isset($request->email)) {
            $newsLetter->email = $request->email;
        }

        if (isset($request->status)) {
            $newsLetter->status = $request->status;
        }

        $newsLetter->save();

        return $newsLetter;
    }


    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAttribute()
    {
        return ucfirst($this->creater->name);
    }

    /**
     * Get the phone associated with the user.
     */
    public function creater()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function deleter()
    {
        return $this->hasone(User::class, 'id', 'deleted_by')->withTrasheds();
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
