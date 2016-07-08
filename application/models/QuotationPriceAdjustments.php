<?php

class QuotationPriceAdjustments extends Eloquent {
    public static $timestamps = false;
    public static $table = 'quotation_price_adjustments';

    public static function getPrice($name){
        $priceQuery = QuotationPriceAdjustments::where('name', '=', $name)->first();
        if($priceQuery !== null) return number_format($priceQuery->price, 2);
        return 0;
    }

    public static function getNote($name){
        $priceQuery = QuotationPriceAdjustments::where('name', '=', $name)->first();
        if($priceQuery !== null) return $priceQuery->note;
        return '';
    }
}