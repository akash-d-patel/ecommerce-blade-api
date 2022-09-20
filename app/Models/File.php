<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class File extends Model
{
    use HasFactory;
    use PimpableTrait;
    public $timestamps = false;
    protected $table = 'files';

    protected $sortParameterName = 'sort';

    public $sortable = [ 'path'];

    protected $searchable = ['search_txt', 'path'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('path', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }


    public static function createUpdate($brand, $file, $request)
    {

        if (isset($request->path)) {
            $file->path = $request->path;
        }

        $brand->files()->save($file);

        return $file;
    }

    /**
     * Get all of the models that own files.
     */
    public function filetable()
    {
        return $this->morphTo();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'filetable_id', 'id')->where('filetable_type','App\Models\Brand');
    }
}
