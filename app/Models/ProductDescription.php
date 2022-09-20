<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class ProductDescription extends Model
{
    use HasFactory;
    use PimpableTrait;

    public $timestamps = false;
    protected $table = 'product_descriptions';

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'created_at'];

    protected $searchable = ['search_txt', 'title'];


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
                
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }
    
    /**
     * Get the post that owns the comment.
     */
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'descriptiontable_id','id')->where('descriptiontable_type', Product::class);
    }

    public static function createUpdate($product, $productdescription,$request) {
         
        if(isset($request->title)) {
            $productdescription->title = $request->title;
        }

        if(isset($request->content)) {
            $productdescription->content = $request->content;
        }

        $product->descriptions()->save($productdescription);
        return $productdescription;
       
    }
    public function descriptiontable()
    {
        return $this->morphTo();
    }

}
