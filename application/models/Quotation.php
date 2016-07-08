<?php

class Quotation extends Eloquent {
    public static $timestamps = false;
    public static $table = 'quotation';

    public function layout()
    {
        return $this->has_one('Layout', 'quotation_layouts_id');
    }

    public static function calcDeliver(){
        $deliveryDistance = new Postcodes();
        $deliveryDistance = round($deliveryDistance->HowFar(\Laravel\Session::get('quote_postcode')));
        $paidDistance = ($deliveryDistance - 100 > 0) ? $deliveryDistance - 100 : 0;

        if($paidDistance > 0) $price = $paidDistance * QuotationPriceAdjustments::getPrice('delivery_per_mile');

        return array(
            'totalDistance' => $deliveryDistance,
            'paidDistance' => $paidDistance,
            'price' => $price
        );
    }

    // Calculate quotation pricing using the session data
    // We only want to calculate totals up to a certain stage
    public static function calcSessionQuotationCurrentValue($upTo){
        $price = 0;

        // Init stage
        $layout = \Laravel\Session::get('quote_layout');
        $price = $layout->cost;
        $deliveryData = self::calcDeliver();
        $price = $price + $deliveryData['price'];
        if($upTo == "init") return (float)$price;

        // Customise stage - Stage 1
        $price = $price + \Laravel\Session::get('quote_customise_swap_window', 0) * QuotationPriceAdjustments::getPrice('swap_window_wall');
        $price = $price + \Laravel\Session::get('quote_customise_swap_wall', 0) * QuotationPriceAdjustments::getPrice('swap_wall_window');
        $price = $price + \Laravel\Session::get('quote_customise_extra_door', 0) * QuotationPriceAdjustments::getPrice('add_extra_door');
        $price = $price + \Laravel\Session::get('quote_customise_fanlight', 0) * QuotationPriceAdjustments::getPrice('add_fanlight_window');
        $price = $price + \Laravel\Session::get('quote_customise_half_window', 0) * QuotationPriceAdjustments::getPrice('add_half_window');
        $price = $price + \Laravel\Session::get('quote_customise_picture_window', 0) * QuotationPriceAdjustments::getPrice('add_1820_window');
        if($upTo == "customise") return (float)$price;

        // Decking / Flyover stage - Stage 2
        $price = $price + \Laravel\Session::get('quote_decking_composite_deck_910_910', 0) * QuotationPriceAdjustments::getPrice('composite_deck_910_910');
        $price = $price + \Laravel\Session::get('quote_decking_composite_deck_910_1820', 0) * QuotationPriceAdjustments::getPrice('composite_deck_910_1820');
        $price = $price + \Laravel\Session::get('quote_decking_composite_deck_910_2730', 0) * QuotationPriceAdjustments::getPrice('composite_deck_910_2730');
        $price = $price + \Laravel\Session::get('quote_decking_flyover_roof_910_910', 0) * QuotationPriceAdjustments::getPrice('flyover_roof_910_910');
        $price = $price + \Laravel\Session::get('quote_decking_flyover_roof_910_1820', 0) * QuotationPriceAdjustments::getPrice('flyover_roof_910_1820');
        $price = $price + \Laravel\Session::get('quote_decking_flyover_roof_910_2730', 0) * QuotationPriceAdjustments::getPrice('flyover_roof_910_2730');
        if($upTo == "deckingflyover") return (float)$price;

        // Electrics stage - Stage 3
        $price = $price + \Laravel\Session::get('quote_electrics_double_sockets_450', 0) * QuotationPriceAdjustments::getPrice('electrics_double_sockets_450');
        $price = $price + \Laravel\Session::get('quote_electrics_double_sockets_1150', 0) * QuotationPriceAdjustments::getPrice('electrics_double_sockets_1150');
        $price = $price + \Laravel\Session::get('quote_electrics_light_switch', 0) * QuotationPriceAdjustments::getPrice('electrics_light_switch');
        $price = $price + \Laravel\Session::get('quote_electrics_panel_heater', 0) * QuotationPriceAdjustments::getPrice('electrics_panel_heater');
        $price = $price + \Laravel\Session::get('quote_electrics_double_floor_socket', 0) * QuotationPriceAdjustments::getPrice('electrics_double_floor_socket');
        $price = $price + \Laravel\Session::get('quote_electrics_fused_spur_socket', 0) * QuotationPriceAdjustments::getPrice('electrics_fused_spur_socket');
        if($upTo == "electrics") return (float)$price;

        // Electrics stage - Stage 4
        $price = $price + \Laravel\Session::get('quote_internals_silver_aluminium_venitian_blind_no_screws', 0) * QuotationPriceAdjustments::getPrice('silver_aluminium_venitian_blind_no_screws');
        $price = $price + \Laravel\Session::get('quote_internals_recessed_blinds', 0) * QuotationPriceAdjustments::getPrice('recessed_blinds');
        $price = $price + \Laravel\Session::get('quote_internals_internal_910_partition_wall', 0) * QuotationPriceAdjustments::getPrice('internal_910_partition_wall');
        $price = $price + \Laravel\Session::get('quote_internals_internal_door_dividing_studio', 0) * QuotationPriceAdjustments::getPrice('internal_door_dividing_studio');
        $price = $price + \Laravel\Session::get('quote_internals_internal_wall_corner_post', 0) * QuotationPriceAdjustments::getPrice('internal_wall_corner_post');
        if($upTo == "interior") return (float)$price;

        // Other stage - Stage 5
        $price = $price + \Laravel\Session::get('quote_other_decoupled_floor', 0) * QuotationPriceAdjustments::getPrice('other_decoupled_floor');
        $price = $price + \Laravel\Session::get('quote_other_aquastep_oak_floor', 0) * QuotationPriceAdjustments::getPrice('other_aquastep_oak_floor');
        $price = $price + \Laravel\Session::get('quote_other_walls_to_timber', 0) * QuotationPriceAdjustments::getPrice('other_walls_to_timber');
        $price = $price + \Laravel\Session::get('quote_other_taller_walls', 0) * QuotationPriceAdjustments::getPrice('other_taller_walls');
        $price = $price + \Laravel\Session::get('quote_other_entry_steps', 0) * QuotationPriceAdjustments::getPrice('other_entry_steps');
        $price = $price + \Laravel\Session::get('quote_other_entry_handrail', 0) * QuotationPriceAdjustments::getPrice('other_entry_handrail');
        $price = $price + \Laravel\Session::get('quote_other_skirt', 0) * QuotationPriceAdjustments::getPrice('other_skirt');
        if($upTo == "other") return (float)$price;

        return $price;
    }
}