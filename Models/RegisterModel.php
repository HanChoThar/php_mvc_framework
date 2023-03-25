<?php

namespace App\Models;

use App\core\Model;

/**
 * Class RegisterModel
 * 
 * @author Han Cho Thar
 * @package App\Models
 */
class RegisterModel extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirm_password;

    public function register()
    {
        echo "creating new user";
    }

    public function rules(): array
    {
        return [
            'fname' => [self::RULES_REQUIRED],
            'lname' => [self::RULES_REQUIRED],
            'email' => [self::RULES_REQUIRED, self::RULES_EMAIL],
            'password' => [self::RULES_REQUIRED, [self::RULES_MINIMUM, 'min' => 8], [self::RULES_MINIMUM, 'max' => 16]],
            'confirm_password' => [self::RULES_REQUIRED, [self::RULES_MATCH, 'match' => 'password']]
        ];
    }
    
}