<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;
    use PimpableTrait;
    protected $table = 'images';

    protected $sortParameterName = 'sort';

    public $sortable = ['id', 'title'];

    protected $searchable = ['search_txt', 'title', 'alt'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('title', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('alt', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function createUpdateBanner($banner, $image, $request)
    {

        if (isset($request->title)) {
            $image->title = $request->title;
        }

        if (isset($request->alt)) {
            $image->alt = $request->alt;
        }

        if (isset($request->path)) {
            $image->path = $request->path;
        }
        $banner->images()->save($image);

        return $image;
    }
    public static function createUpdateBrand($brand, $image, $request)
    {

        if (isset($request->title)) {
            $image->title = $request->title;
        }

        if (isset($request->alt)) {
            $image->alt = $request->alt;
        }

        if (isset($request->path)) {
            $image->path = $request->path;
        }
        $brand->images()->save($image);

        return $image;
    }
    public static function createUpdateCategory($category, $image, $request)
    {

        if (isset($request->title)) {
            $image->title = $request->title;
        }

        if (isset($request->alt)) {
            $image->alt = $request->alt;
        }

        if (isset($request->path)) {
            $image->path = $request->path;
        }
        $category->images()->save($image);

        return $image;
    }
    public static function createUpdateNews($news, $image, $request)
    {

        if (isset($request->title)) {
            $image->title = $request->title;
        }

        if (isset($request->alt)) {
            $image->alt = $request->alt;
        }

        if (isset($request->path)) {
            $image->path = $request->path;
        }
        $news->images()->save($image);

        return $image;
    }
    public static function createUpdateProduct($product, $image, $request)
    {

        if (isset($request->title)) {
            $image->title = $request->title;
        }

        if (isset($request->alt)) {
            $image->alt = $request->alt;
        }

        if (isset($request->path)) {
            $image->path = $request->path;
        }
        $product->images()->save($image);

        return $image;
    }

    public function imagetable()
    {

        return $this->morphTo();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'imagetable_id', 'id')->where('imagetable_type','App\Models\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'imagetable_id', 'id')->where('imagetable_type','App\Models\Category');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'imagetable_id', 'id')->where('imagetable_type','App\Models\Product');
    }

    public function news()
    {
        return $this->belongsTo('App\Models\news', 'imagetable_id', 'id')->where('imagetable_type','App\Models\news');
    }

    public function banner()
    {
        return $this->belongsTo('App\Models\Banner', 'imagetable_id', 'id')->where('imagetable_type','App\Models\Banner');
    }
}
