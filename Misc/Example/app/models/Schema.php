<?php

	class Schema extends Eloquent
	{
         
           
            protected $guarded = array('id');
          protected $fillable = array('name', 'label','data');

 
  // public static $rules = array(
  //   'name' => 'required|min:25',
  //   'label' => 'required|label',
  //   'data' => 'required|data'
  // );

	}