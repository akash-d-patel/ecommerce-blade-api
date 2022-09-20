<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "products";
    protected $fillable = ['path'];

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

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($product) {
            $product->created_by = Auth::user()->id;
            $product->order = self::count() + 1;
        });

        self::created(function ($product) {
            // ... code here
        });

        self::updating(function ($product) {
            $product->updated_by = Auth::user()->id;
        });

        self::updated(function ($product) {
            // ... code here
        });

        self::deleting(function ($product) {
            $product->deleted_by = Auth::user()->id;
            $product->save();
        });

        self::deleted(function ($product) {
        });
    }


    public static function createUpdate($product, $request)
    {

        if (isset($request->brand_id)) {
            $product->brand_id = null;
            if (!is_null($request->brand_id)) {
                $product->brand_id = $request->brand_id;
            }
        }

        if (isset($request->client_id)) {
            $product->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $product->name = $request->name;
        }

        if (isset($request->description)) {
            $product->description = $request->description;
        }

        if (isset($request->status)) {
            $product->status = $request->status;
        }

        $product->save();

        return $product;
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

    public function descriptions()
    {
        return $this->morphMany(ProductDescription::class, 'descriptiontable');
    }

    /**
     * Get the post's image.
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewtable');
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seotable');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
