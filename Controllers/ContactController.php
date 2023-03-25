<?php

namespace App\Controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;

class ContactController extends Controller{


    public function home()
    {
        $info = [
            'name' => 'han cho thar',
        ];
        
        return $this->render('home', $info);
    }

    public function handleContact() 
    {
        return $this->render('contact');
    }

    public function contact(Request $request) 
    {
        // var_dump($_POST);
        var_dump($request->getBody());
        echo 'world that is here';
    }

}