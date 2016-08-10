<?php

class User_Quotations_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
    }

    public function get_pricing()
    {
        $pricing = QuotationPriceAdjustments::order_by('id', 'asc')->get();
        return View::Make('user.quotations.pricing')->with('pricing', $pricing);
    }

    public function post_pricing()
    {
        $update_pricing = array(
            'price_list' => Input::get('pricing')
        );

        foreach($update_pricing['price_list'] as $k => $v) {
            $priceAdjustment = QuotationPriceAdjustments::find($k);
            $priceAdjustment->update($priceAdjustment->id, array('price' => $v));
        }

        return Redirect::to('/user/quotations/pricing/')->with('success','Quotation pricing has been updated');
    }

    public function get_pricing_view()
    {
        $price = QuotationPriceAdjustments::find(URI::Segment(4));
        return View::make('user.quotations.pricing_view')->with('price', $price);
    }

    public function post_pricing_view()
    {
        $price = QuotationPriceAdjustments::find(URI::Segment(4));

        $update_layout = array(
            'friendly_name' => trim(Input::get('friendly_name')),
            'note' => trim(Input::get('note')),
        );

        $price->update($price->id, $update_layout);

        return Redirect::to('/user/quotations/pricing_view/' . $price->id)->with('success','Update successfull');
    }

    public function get_view()
    {
        $quotes = Quotation::order_by('id', 'asc')->get();
        return View::Make('user.quotations.view')->with('quotes', $quotes);
    }

}