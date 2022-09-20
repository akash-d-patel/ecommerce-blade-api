<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Tax extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = "taxes";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'percentage', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'percentage'];

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
                    ->orwhere('percentage', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($tax) {
        });

        self::created(function ($tax) {
            // ... code here
        });

        self::updating(function ($tax) {
        });

        self::updated(function ($tax) {
            // ... code here
        });

        self::deleting(function ($tax) {
        });

        self::deleted(function ($tax) {
        });
    }

    public static function addUpdate($tax, $request)
    {
        if (isset($request->client_id)) {
            $tax->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $tax->name = $request->name;
        }

        if (isset($request->percentage)) {
            $tax->percentage = $request->percentage;
        }

        $tax->save();

        return $tax;
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
