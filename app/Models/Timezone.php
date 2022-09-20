<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Timezone extends Model
{
    use HasFactory;
    use PimpableTrait;
    protected $table = "timezones";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'abbreviation', 'offSet'];

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
                    ->orWhere('abbreviation', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('offSet', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function addUpdate($timezone, $request)
    {
        if (isset($request->client_id)) {
            $timezone->client_id = $request->client_id;
        }

        if (isset($request->name)) {
            $timezone->name = $request->name;
        }

        if (isset($request->abbreviation)) {
            $timezone->abbreviation = $request->abbreviation;
        }

        if (isset($request->offSet)) {
            $timezone->offSet = $request->offSet;
        }

        $timezone->save();

        return $timezone;
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
