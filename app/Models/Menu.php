<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "menus";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'status'];

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

        self::creating(function ($menu) {
            $menu->created_by = Auth::user()->id;
        });

        self::created(function ($menu) {
            // ... code here     
        });

        self::updating(function ($menu) {
            $menu->updated_by = Auth::user()->id;
        });

        self::updated(function ($menu) {
            // ... code here
        });

        self::deleting(function ($menu) {
            $menu->deleted_by = Auth::user()->id;
            $menu->save();
        });

        self::deleted(function ($menu) {
        });
    }


    public static function createUpdate($menu, $request)
    {

        if (isset($request->client_id)) {
            $menu->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $menu->name = $request->name;
        }

        if (isset($request->description)) {
            $menu->description = $request->description;
        }

        if (isset($request->status)) {
            $menu->status = $request->status;
        }

        $menu->save();

        return $menu;
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
