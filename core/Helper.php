<?php

namespace App\core;

class Helper {

    
    public static function dd($variable) {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        die();
    }
}