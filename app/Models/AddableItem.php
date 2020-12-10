<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AddableItem extends Model
{
    use HasFactory;

    protected $table = 'addable_items';

    protected $appends = ['formatted_price'];

    protected $guarded = ['id'];

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