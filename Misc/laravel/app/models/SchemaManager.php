<?php

	class SchemaManager extends Eloquent
	{
         
  
            protected $table = 'schema_managers';
            protected $guarded = array('id');
        //  protected $fillable = array('name', 'label','data');

  protected $fillable = [];
  
  // public static $rules = array(
  //   'name' => 'required|min:5',
  //   'label' => 'required|label',
  //   'data' => 'required|data'
  // );

public static $rules = [
       'name' => 'required',
    'label' => 'required',
    'data' => 'required'
  ];


 


	}