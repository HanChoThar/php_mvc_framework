<?php

namespace App\Controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Helper;
use App\core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller {

    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    /**
     * @param \App\core\Request $request
     */
    public function register(Request $request) 
    {
        $registerModel = new RegisterModel();
        
        if($request->isPost()) {
            $registerModel->loadData($request->getBody());
            
            if($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }

            // Helper::dd($registerModel);

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}