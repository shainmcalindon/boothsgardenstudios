<?php

class Planoption extends Eloquent
{
	public static $hidden = array('group');
	
	public static function getGrouped()
	{
		$all = static::order_by('group')->order_by('sort_order')->get();
		
		$return = array();
		foreach ($all as $option) {
			$return[$option->group][] = $option;
		}
		
		return $return;
	}
	
	public function to_array()
	{
		$data = parent::to_array();
		foreach ($data as $k => &$v) {
			if (in_array($k, array('id', 'outer_wall', 'inner_wall', 'decking', 'global', 'per_block', 'sort_order'))) $v = (int)$v;
		}
		return $data;
	}
}
