<?php

// app/models/Myschema.php

class Myschema extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('name', 'label', 'data' ); 
}

	