<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "cities";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'created_at'];

    protected $searchable = ['search_txt', 'name'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('name', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($city) {

            if(Auth::check()) {
                $city->created_by = Auth::user()->id;
            }
        });

        self::created(function ($city) {
            // ... code here     
        });

        self::updating(function ($city) {
            $city->updated_by = Auth::user()->id;
        });

        self::updated(function ($city) {
            // ... code here
        });

        self::deleting(function ($city) {
            $city->deleted_by = Auth::user()->id;
            $city->save();
        });

        self::deleted(function ($city) {
        });
    }


    public static function createUpdate($city, $request)
    {

        if (isset($request->client_id)) {
            $city->client_id = $request->client_id;
        }

        if (isset($request->state_id)) {
            $city->state_id = null;
            if (!is_null($request->state_id)) {
                $city->state_id = $request->state_id;
            }
        }

        if (isset($request->name)) {
            $city->name = $request->name;
        }

        $city->save();

        return $city;
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
     * Get the phone associated with the user.
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
