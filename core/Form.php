<?php

namespace App\core;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form;
    }

    public static function field(Model $model, $attribute) 
    {
        return new Field($model, $attribute);
    }

    public static function end(){
        echo '</form>';
    }


}