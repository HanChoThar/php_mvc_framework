<?php

namespace App\core;

abstract class Model
{
    public const RULES_REQUIRED = 'required';
    public const RULES_MINIMUM = 'min';
    public const RULES_MAXIMUM = 'max';
    public const RULES_EMAIL = 'email';
    public const RULES_MATCH = 'match';
    public static $model;

    public $errors = [];

    public function __construct()
    {
        self::$model = $this;
    }

    public function loadData($data) {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if($ruleName == self::RULES_REQUIRED && !$value) {
                    $this->addErrors($attribute, self::RULES_REQUIRED);
                }
                if($ruleName == self::RULES_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, self::RULES_EMAIL);
                }
                if($ruleName == self::RULES_MINIMUM && strlen($value) < $rule['min']) {
                    $this->addErrors($attribute, self::RULES_MINIMUM, $rule);
                }
                if($ruleName == self::RULES_MAXIMUM && strlen($value) > $rule['max']) {
                    $this->addErrors($attribute, self::RULES_MAXIMUM, $rule);
                }
                if($ruleName == self::RULES_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrors($attribute, self::RULES_MATCH, $rule);
                }
            }
        }
        
        return empty($this->errors);
    }

    public function addErrors(string $attribute, string $ruleName, $params = [])
    {
        $errorsMessages = $this->errorMessages()[$ruleName] ?? '';
        foreach ($params as $key => $value) {
            $errorsMessages = str_replace("{{$key}}", $value, $errorsMessages);
        }
        $this->errors[$attribute][] = $errorsMessages;
    }

    public function errorMessages() 
    {
        return [
            self::RULES_REQUIRED => 'This field is required',
            self::RULES_MINIMUM => 'Min length of field must be {min}',
            self::RULES_MAXIMUM => 'Max length of field must be {max}',
            self::RULES_EMAIL => 'This field must be valid email address',
            self::RULES_MATCH => 'This field must be the same as {match}',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}