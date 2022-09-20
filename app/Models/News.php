<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "news";

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'title', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('title', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($news) {
            
            if(Auth::check()) {
                $news->created_by = Auth::user()->id;
                $news->order = self::count() + 1;
            }   
        });

        self::created(function ($news) {
            // ... code here
        });

        self::updating(function ($news) {
            $news->updated_by = Auth::user()->id;
        });

        self::updated(function ($news) {
            // ... code here
        });

        self::deleting(function ($news) {
            $news->deleted_by = Auth::user()->id;
            $news->save();
        });

        self::deleted(function ($news) {
        });
    }

    public static function addUpdatenews($news, $request)
    {

        if (isset($request->client_id)) {
            $news->client_id = $request->client_id;
        }

        if (isset($request->title)) {
            $news->title = $request->title;
        }

        if (isset($request->short_description)) {
            $news->short_description = $request->short_description;
        }

        if (isset($request->description)) {
            $news->description = $request->description;
        }

        if (isset($request->order)) {
            $news->order = $request->order;
        }

        if (isset($request->status)) {
            $news->status = $request->status;
        }

        $news->save();

        return $news;
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

    /**
     * Get the post's image.
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewtable');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
