<?php

class Plan extends Eloquent
{
//	public $grid;
//	public $joins;
//	public $size;
//	public $width;
//	public $height;

	public static $valid_sizes = array(
        '1820x1820', '2730x1820', '3640x1820', '4550x1820', '5460x1820', '6370x1820', '7280x1820', '8190x1820', '9100x1820', '10010x1820',
                     '2730x2730', '3640x2730', '4550x2730', '5460x2730', '6370x2730', '7280x2730', '8190x2730', '9100x2730', '10010x2730',
                                  '3640x3640', '4550x3640', '5460x3640', '6370x3640', '7280x3640', '8190x3640', '9100x3640', '10010x3640',
    );

    public function planoptions()
    {
        return $this->has_many_and_belongs_to('Planoption', 'plans_planoptions');
    }

    public function getPlanoptionsJson()
    {
        $data = array();
        foreach ($this->planoptions()->pivot()->get() as $row) {
            $data[] = array_only($row->to_array(), array(
                'planoption_id',
                'row',
                'column',
                'quantity',
            ));
        }
        foreach ($data as &$v) { // map the data as required for the JS
            $v['id'] = $v['planoption_id'];
            unset($v['planoption_id']);
        }

        return json_encode($data);
    }

    public function set_email_address($value='')
    {
        $this->attributes['email_address'] = strtolower($value);
    }

    public function set_postcode($value='')
    {
        $this->attributes['postcode'] = preg_replace("/[^A-Z0-9]/", "", strtoupper($value));
    }

	public function setSize($size)
	{
//		if (!in_array($size, static::$valid_sizes)) throw new Exception('Invalid plan size');
//		$size = explode("x", $size);
//		array_walk($size, function(&$v) { $v = (int) $v; });
//		$this->size = $size;
//		$this->width = $size[0]/910;
//		$this->height = $size[1]/910;
//
//		#dd($this);
//
//		$this->grid = array();
//		$this->joins = array();
//
//		for ($x = 1; $x <= $this->width; $x++) {
//			for ($y = 1; $y <= $this->height; $y++) {
//				$this->grid["{$x}|{$y}"] = new stdClass();
//
//				if ($y == 1) continue;
//
//				$this->joins["{$x}|".($y-1)."-{$x}|{$y}"] = new stdClass();
//			}
//		}
//		ksort($this->grid);
//		ksort($this->joins);
//
//		#dd($this);

		if (!in_array($size, static::$valid_sizes)) throw new Exception('Invalid plan size');
		$this->dimensions = $size;
        $size = explode("x", $size);
		$this->columns = (int) $size[0]/910;
		$this->rows = (int) $size[1]/910;
	}
}
