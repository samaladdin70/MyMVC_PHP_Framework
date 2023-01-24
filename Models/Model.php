<?php

namespace Models;

/**
 * Model
 */
class Model
{
    const ERR_REQUIRED = 'This field is required';
    const ERR_NAME = 'Only letters and white space allowed';
    const ERR_EMAIL_VALIDATE = 'This email not a valid email type';
    const ERR_MATCH_PASSWORD = 'This not matches password';
    const ERR_LENGTH = 'This field length must has at least 6 char';
    const ERR_STRENGTH = 'Password should include at least 1 upper case letter, 1 number, and 1 special character.';
    const ERR_UNIQUE = 'This (()) Was Already Exist and Used';
    const NOT_EXIST = 'Your email is not found';
    const WRONG_PASS = 'Password is incorrect';
    const NOT_VERIFIED = 'Your Account still Not vrefied Check your email';
    const NOT_ACTIVATED = 'Your Account inactive!';
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $remember;

    function __construct()
    {
        if (isset($_POST['firstname'])) {
            $this->firstname = $this->test_input($_POST['firstname']);
        }
        if (isset($_POST['lastname'])) {
            $this->lastname = $this->test_input($_POST['lastname']);
        }
        if (isset($_POST['email'])) {
            $this->email = $this->test_input($_POST['email']);
        }
        if (isset($_POST['password'])) {
            $this->password = $this->test_input($_POST['password']);
        }
        if (isset($_POST['confirmPassword'])) {
            $this->confirmPassword = $this->test_input($_POST['confirmPassword']);
        }
        if (isset($_POST['username'])) {
            $this->username = $this->test_input($_POST['username']);
        }
        if (isset($_POST['remember'])) {
            $this->remember = $_POST['remember']; // "on" or NULL
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}