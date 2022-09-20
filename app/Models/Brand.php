<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "brands";

    protected $fillable = ['name', 'description', 'order', 'status'];

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

    public static function getBrand()
    {
        $records = DB::table('brands')->select('id', 'name', 'description', 'order', 'status')->get()->toArray();
        return $records;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($brand) {

            if(Auth::check()) {

            $brand->created_by = Auth::user()->id;
            $brand->order = self::count() + 1;
        
            }
        });

        self::created(function ($brand) {
            // ... code here
        });

        self::updating(function ($brand) {
            $brand->updated_by = Auth::user()->id;
        });

        self::updated(function ($brand) {
            // ... code here
        });

        self::deleting(function ($brand) {
            $brand->deleted_by = Auth::user()->id;
            $brand->save();
        });

        self::deleted(function ($brand) {
        });
    }

    public static function addUpdatedBrands($brand, $request)
    {
        if (isset($request->client_id)) {
            $brand->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $brand->name = $request->name;
        }

        if (isset($request->description)) {
            $brand->description = $request->description;
        }

        if (isset($request->order)) {
            $brand->order = $request->order;
        }

        if (isset($request->status)) {
            $brand->status = $request->status;
        }

        $brand->save();

        return $brand;
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
     * Get all of the brands's files.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'filetable');
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
