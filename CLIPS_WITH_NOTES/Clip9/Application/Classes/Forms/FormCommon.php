<?php
/**
 * Form Common Class
 */
Require 'FormBase.php';

// inherits FormBase base class, maybe like a webpack merge() with
// a common webpack.common.js file. This will contain fields that
// are common amongst all forms, or fields that all of them will use
// in some way or another
class FormCommon extends FormBase
{
    /**
     * @param $model
     * @param array $params
     */
    // if we have a constructor in the base class, it should be
    // applicable to all sub classes
    public function __construct($models, $params)
    {
        parent::__construct($models, $params);

        //Add a hidden token for CSRF protection
        $token = md5(time());
        $this->addField([
            'name' => 'token',
            'type' => 'hidden',
            'value' => $token,
            'priority' => 99,
            'validator' => 'token',
        ]);

        //Add a submit button
        $this->addField([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Submit',
            'priority' => 100,
        ]);
    }
}