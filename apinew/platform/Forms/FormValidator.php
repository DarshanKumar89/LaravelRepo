<?php

namespace Platform\Forms;

use Illuminate\Validation\Factory as Validator;

/**
 * Class Form
 * @package Platform\Forms
 */
abstract class FormValidator {

    /**
     * @var \Illuminate\Validation\Factory
     */
        protected $validator;

    /**
     * @var
     */
    protected $validation;

    /**
     * @param Validator $validator
     */
    function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }


    public function validate(array $formdata)
    {
        $this->validation = $this->validator->make($formdata, $this->getValidationRules());

        if($this->validation->fails())
        {
            throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }

        return true;
    }

    /**
     * @return mixed
     */
    protected function getValidationRules(){
        return $this->rules;
    }


    /**
     * @return mixed
     */
    protected function getValidationErrors(){
        return $this->validation->errors();
    }
}