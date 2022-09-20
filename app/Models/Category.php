<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{

    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "categories";

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
     
        self::creating(function ($category) {

            if(Auth::check()) {

            $category->created_by = Auth::user()->id;
            $category->order = self::count() + 1;
        }
        });
    

        self::created(function ($category) {
            // ... code here     
        });

        self::updating(function ($category) {
            $category->updated_by = Auth::user()->id;
        });

        self::updated(function ($category) {
            // ... code here
        });

        self::deleting(function ($category) {
            $category->deleted_by = Auth::user()->id;
            $category->save();
        });

        self::deleted(function ($category) {
        });
    }


    public static function createUpdate($category, $request)
    {
        if (isset($request->client_id)) {
            $category->client_id = $request->client_id;
        }

        if (isset($request->parent_id)) {
            $category->parent_id = null;
            if ($request->parent_id > 0) {
                $category->parent_id = $request->parent_id;
            }
        }

        if (isset($request->name)) {
            $category->name = $request->name;
        }

        if (isset($request->description)) {
            $category->description = $request->description;
        }

        if (isset($request->status)) {
            $category->status = $request->status;
        }

        $category->save();

        return $category;
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



    public function images()
    {

        return $this->morphMany(Image::class, 'imagetable');
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seotable');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
