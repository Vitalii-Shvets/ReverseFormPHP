<?php

class ValidationService
{
    /**
     * @param $request
     * @return bool|string
     */
    public function validationRequire($request)
    {
        if (strlen(trim($request)) < 1) {
            return 'Enter require fills';
        }

        return true;
    }

    /**
     * @param $email
     * @return bool|string
     */
    public function validationEmail($email)
    {
        if (strlen(trim($email)) != '') {
            $rv_email = '/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/';
            if (!preg_match($rv_email, $email)) {
                return 'Incorrect email';
            }
        }

        return true;
    }

    /**
     * @param string $phone
     * @return bool|string
     */
    public function validationPhone($phone)
    {
        if (preg_match("/^[0-9]{10}$/", $phone)) {
            return true;
        }

        return 'The phone must contain only 10 digits';
    }


}