<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // here is static method for permanently delete
    protected static function booted()
    {
        static::addGlobalScope('deleted', function (Builder $builder){
            $builder->where('deleted', 0);
        });
    }

    // method for split slug with operator -
    // this method will be invoked when product created
    public static function boot()
    {
        parent::boot();

        self::saving(function ($model){
            $numberOfProductsWithSameName = Product::where('name', $model->name)->count();

            if($numberOfProductsWithSameName){
                $model->slug = Str::slug($model->name, '-') . '-' . $numberOfProductsWithSameName;
            } else{
                $model->slug = Str::slug($model->name, '-');
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
