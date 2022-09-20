<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "coupons";

    protected $sortParameterName = 'sort';

    public $sortable = ['code', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'code', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('code', $constraint->getOperator(), $constraint->getValue());
                //->orWhere('status', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }


    public static function createUpdate($coupon, $request)
    {

        if (isset($request->client_id)) {
            $coupon->client_id = $request->client_id;
        }

        if (isset($request->code)) {
            $coupon->code = $request->code;
        }

        if (isset($request->discount_type)) {
            $coupon->discount_type = $request->discount_type;
        }

        if (isset($request->no_of_attemets)) {
            $coupon->no_of_attemets = $request->no_of_attemets;
        }
        if (isset($request->minimum_order_value)) {
            $coupon->minimum_order_value = $request->minimum_order_value;
        }
        if (isset($request->maximum_discount)) {
            $coupon->maximum_discount = $request->maximum_discount;
        }
        if (isset($request->expire_date)) {
            $coupon->expire_date = $request->expire_date;
        }

        if (isset($request->status)) {
            $coupon->status = $request->status;
        }

        $coupon->save();

        return $coupon;
    }
    public static function boot()
    {

        parent::boot();

        self::creating(function ($coupon) {
            $coupon->created_by = Auth::user()->id;
            $coupon->minimum_order_value = self::count() + 1;
        });

        self::created(function ($coupon) {
            // ... code here
        });

        self::updating(function ($coupon) {
            $coupon->updated_by = Auth::user()->id;
        });

        self::updated(function ($coupon) {
            // ... code here
        });

        self::deleting(function ($coupon) {
            $coupon->deleted_by = Auth::user()->id;
            $coupon->save();
        });

        self::deleted(function ($coupon) {
        });
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
