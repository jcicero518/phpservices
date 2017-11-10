<?php
/**
 * Login Form Class
 */
require 'FormCommon.php';
// this class inherits from FormCommon, which itself inherits from FormBase
// so we have a two level inheritance, this class has ancestors
class LoginForm extends FormCommon
{
    /**
     * @param $model
     * @param array $params
     */
    public function __construct($model)
    {
        // set params local to this class / the login form and
        // pass to the parent constructor. Kind of a defaults array to merge
        $params = [
            'name' => 'login',
            'id' => 'form1',
            'method' => 'post',
            'action' => 'index.php',
        ];
        parent::__construct($model, $params);

        //Add a username field
        // field that is specific to just this class or this form
        $this->addField([
            'label' => 'Username',
            'type' => 'text',
            'name' => 'username',
            'priority' => 1,
            'required' => true,
            'value' => '',
            'validator' => [
                'StringLength' => [
                    'minimum' => 8,
                    'maximum' => 30,
                ],
                'alnum',
                'required',
            ],
        ]);

        //Add a password field
        $this->addField([
            'label' => 'Password',
            'type' => 'password',
            'name' => 'password',
            'priority' => 2,
            'required' => true,
            'value' => '',
            'validator' =>[
                'StringLength' => [
                    'minimum' => 12,
                    'maximum' => 30,
                ],
                'required',
            ],
        ]);

        //Adjust the button attributes
        /* TODO: My notes - we use the top base class methods to change submit button value */
        $button = $this->getField('Submit');
        $button->setValue('login'); // PHPStorm doesn't seem to know about > 1 level of inheritance

        //Sort the fields by priority
        ksort($this->fields);
    }
}