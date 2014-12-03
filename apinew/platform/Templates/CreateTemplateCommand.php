<?php

namespace Platform\Templates;

//$newTemplate = CreateTemplateCommand($template_name, $template_style_ref, $template_data_json_string);

class CreateTemplateCommand {
    public $name;
    public $style_ref;
    public $json_data;

    function __construct ($name, $style_ref, $json_data)
    {
        $this->name = $name;
        $this->style_ref = $style_ref;
        $this->json_data = $json_data;
    }


}