<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Akaunting\Money\Currency as PCurrency;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $appends = ['formatted_price'];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    
    public function ingredients(){
        return $this->belongsToMany(Ingredient::class,'products_ingredients');
    }

    public function addableItems(){
        return $this->belongsToMany(AddableItem::class,'products_addable_items');
    }

    public function getActiveAttribute($value){
        return $value == 0 ? 'No' : 'Yes';
    }

    public function getFormattedPriceAttribute($value){

        
        $converting_amount = Currency::where('from_',$this->price_currency)
                            ->where('to_',config('settings.currency'))
                            ->first();



        if($this->price_currency == config('settings.currency')){
            return money($this->price,config('settings.currency'),true)->format(); 
        }else{
            return money($this->price,$this->price_currency,true)->convert(new PCurrency(config('settings.currency')),(float)$converting_amount->amount)->format();
        }
    }
    
}