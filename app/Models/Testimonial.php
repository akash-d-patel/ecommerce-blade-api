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

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = 'testimonials';

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

    public static function createUpdate($testimonial, $request)
    {

        if (isset($request->client_id)) {
            $testimonial->client_id = $request->client_id;
        }

        if (isset($request->title)) {
            $testimonial->title = $request->title;
        }

        if (isset($request->shortdescription)) {
            $testimonial->shortdescription = $request->shortdescription;
        }

        if (isset($request->description)) {

            $testimonial->description = $request->description;
        }

        if (isset($request->order)) {
            $testimonial->order = $request->order;
        }

        if (isset($request->status)) {
            $testimonial->status = $request->status;
        }

        $testimonial->save();
        return $testimonial;
    }

    public static function boot()
    {

        parent::boot();

        self::creating(function ($testimonial) {
            $testimonial->created_by = Auth::user()->id;
            $testimonial->order = self::count() + 1;
        });

        self::updating(function ($testimonial) {
            $testimonial->updated_by = Auth::user()->id;
        });

        self::deleting(function ($testimonial) {
            $testimonial->deleted_by = Auth::user()->id;
            $testimonial->save();
        });
    }

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
