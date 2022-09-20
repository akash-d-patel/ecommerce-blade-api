<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "todos";

    protected $sortParameterName = 'sort';

    public $sortable = ['note', 'created_at'];

    protected $searchable = ['search_txt', 'note', 'is_complete'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('note', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($todo) {
            $todo->created_by = Auth::user()->id;
        });

        self::created(function ($todo) {
            // ... code here     
        });

        self::updating(function ($todo) {
            $todo->updated_by = Auth::user()->id;
        });

        self::updated(function ($todo) {
            // ... code here
        });

        self::deleting(function ($todo) {
            $todo->deleted_by = Auth::user()->id;
            $todo->save();
        });

        self::deleted(function ($todo) {
        });
    }


    public static function createUpdate($todo, $request)
    {

        if (isset($request->client_id)) {
            $todo->client_id = $request->client_id;
        }

        if (isset($request->note)) {
            $todo->note = $request->note;
        }

        if (isset($request->is_complete)) {
            $todo->is_complete = $request->is_complete;
        }

        $todo->save();

        return $todo;
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
