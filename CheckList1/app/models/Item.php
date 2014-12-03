<?php

class Item extends Eloquent {

	protected $fillable = array('name');
	
	public function task() {
		return $this->hasMany('Task');
	}

	public function mark() {
		$this->done = $this->done ? false : true;
		$this->save();
	}
}