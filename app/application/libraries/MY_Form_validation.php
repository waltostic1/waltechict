<?php
class MY_Form_validation extends CI_Form_validation
{

    function __construct($rules = array())
    {
        parent::__construct($rules);

        $this->ci = &get_instance();
    }
    function valid_password($var)
    {

        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{4,200}$/', $var)) {
            $this->set_message('valid_password', 'minimum requirements! [1 special character], [1 numeric character], [1 uppercase] and [1 lowercase]');
            return false;
        } else {
            return true;
        }
    }
}
