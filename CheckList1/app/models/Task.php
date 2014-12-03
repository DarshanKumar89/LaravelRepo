<?php

class Task extends Eloquent {

	protected $fillable = array('name', 'due_date', 'item_id');
	
	public function item() {
		return $this->belongsTo('Item');
	}

	public function mark() {
		$this->done = $this->done ? false : true;
		$this->save();
	}
}