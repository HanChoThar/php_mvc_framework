<?php

namespace App\core;

class Field
{
    public $model;
    public $attribute;

    /**
     * Field constructor
     * 
     * @param \App\core\Model $model
     * @param string $attribute
     */
    public function __construct(\App\core\Model $model, $attribute)
    {
        $this->$model = $model;
        $this->$attribute = $attribute;
    }

    public function __toString()
    {
        return '1';
        // return sprintf('
        // <div class="form-group">
        //     <label>%s</label>
        //     <input type="text" name="%s" value="%s" class="form-control%s">
        // </div>
        // ', $this->attribute, $this->attribute, $this->model->{$this->attribute});
    }
}
