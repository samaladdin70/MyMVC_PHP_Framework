<?php

namespace Models;

use GlobalEnv;
use SQLEnv;

include_once(__DIR__ . '/../SQLEnv.php');
include_once(__DIR__ . '/../GlobalEnv.php');

class RegisterModel extends Model
{
    public array $errors = [];
    public Model $model;
    public SQLEnv $sql;
    public GlobalEnv $tools;



    /**
     * [Description for __construct]
     * making an instance for parent class Model
     * check is method is post to avoid error if form is not post
     * set instance for $errors inside construct to path it in any form 
     * when make an instance for RegisterModel at any form 
     * Then handle data posted if no errors exist
     * 
     * 
     * Created at: 9/22/2022, 2:27:36 AM (Egypt/Cairo)
     * @author     Aladdin Sami
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function __construct()
    {
        $this->model = new Model();
        $this->sql = new SQLEnv();
        $this->tools = new GlobalEnv();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors['firstname'] = [];
            $this->errors['lastname'] = [];
            $this->errors['username'] = [];
            $this->errors['email'] = [];
            $this->errors['password'] = [];
            $this->errors['confirmPassword'] = [];


            $this->nameValidityError('firstname');
            $this->nameValidityError('lastname');
            $this->usernameValidityError('username');
            $this->emailValidityError('email');
            $this->passwordValidityError('password');
            $this->confirmPasswordValidityError('confirmPassword', 'password');

            if (!$this->isErrors()) {
                $this->handlePostedData();
            }
        }
    }

    /**
     * [Description for postData]
     *
     * @return Array contained posted data
     * 
     * Created at: 9/23/2022, 10:31:13 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function postData()
    {
        $postData =
            [
                'firstname' => $this->model->firstname,
                'lastname' => $this->model->lastname,
                'username' => $this->model->username,
                'email' => $this->model->email,
                'password' => $this->model->password
            ];
        return $postData;
    }

    /**
     * [Description for handlePostedData]
     * Handle posted data.
     * @return mixed
     * 
     * Created at: 9/23/2022, 10:35:36 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function handlePostedData()
    {
        /* echo '<div style="position:absolute; top:75px; right:-10px; z-index:100; width:300px;" class="p-4 d-flex justify-content-end">
        <pre class="bg-dark text-warning p-2 rounded" style=" word-wrap: break-word;">';
        var_dump($this->postData());
        echo '</pre>
        </div>'; */
        $this->insertData();
    }



    /**
     * [Description for sqliteTestInput]
     * test if input value is unique (not exists in db table)
     *
     * @param string $input
     * @param string $table
     * 
     * @return mixed
     * 
     * Created at: 10/2/2022, 4:58:48 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function sqliteTestInput(string $input, string $table = 'users')
    {
        $connect = $this->sql->sqlitePDO_Connect();
        $queryMail = "SELECT $input FROM $table WHERE $input = ?";
        $stmt = $connect->prepare($queryMail);
        $stmt->execute([$this->model->$input]);
        if ($stmt) {
            $output = $stmt->fetchAll();
            if (empty($output)) {
                return true;
            } else {

                return false;
            }
        }
    }




    /**
     * [Description for insertData]
     *
     * @param string $table
     * 
     * @return mixed
     * 
     * Created at: 10/2/2022, 6:49:26 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function insertData(string $table = 'users')
    {
        $encryptPassword = $this->tools->code($this->model->password);

        if ($this->sql::SQL_ENV == 'sqlite') {
            if ($this->model->username == '') {
                $qur = "INSERT INTO $table(firstname, lastname,  email, password, time_stamp) VALUES(?, ?, ?, ?, ?)";
                $values =
                    [
                        $this->model->firstname,
                        $this->model->lastname,
                        $this->model->email,
                        $encryptPassword,
                        date('Y-m-d H:i:s')
                    ];
            } else {
                $qur = "INSERT INTO $table(firstname, lastname, username, email, password, time_stamp) VALUES(?, ?, ?, ?, ?, ?)";
                $values =
                    [
                        $this->model->firstname,
                        $this->model->lastname,
                        $this->model->username,
                        $this->model->email,
                        $encryptPassword,
                        date('Y-m-d H:i:s')
                    ];
            }
            $connect = $this->sql->sqlitePDO_Connect();
        } elseif ($this->sql::SQL_ENV == 'mysql') {
            if ($this->model->username == '') {
                $qur = "INSERT INTO $table(firstname, lastname,  email, password) VALUES(?, ?, ?, ?)";
                $values =
                    [
                        $this->model->firstname,
                        $this->model->lastname,
                        $this->model->email,
                        $encryptPassword
                    ];
            } else {
                $qur = "INSERT INTO $table(firstname, lastname, username, email, password) VALUES(?, ?, ?, ?, ?)";
                $values =
                    [
                        $this->model->firstname,
                        $this->model->lastname,
                        $this->model->username,
                        $this->model->email,
                        $encryptPassword
                    ];
            }
            $connect = $this->sql->mysqlPDO_Connect();
        }

        $stmt = $connect->prepare($qur);
        $stmt->execute($values);
        if ($stmt) {
            $id = $connect->lastInsertId();
            $id = $this->tools->code($id);
            header('location: ' . $_SERVER['HTTP_ORIGIN'] . '/agents/sendmail.php?usr=' . $id . '');
            // var_dump($_SERVER);
            //var_dump($id);

        } else {
            echo 'some thing wrong';
        }
    }


    /**
     * [Description for isErrors]
     *
     * @return Bool false for no errors and true for any error exist
     * 
     * Created at: 9/23/2022, 10:36:57 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function isErrors()
    {
        if (empty($this->errors['firstname']) && empty($this->errors['lastname']) && empty($this->errors['email']) && empty($this->errors['password']) && empty($this->errors['confirmPassword']) && empty($this->errors['username'])) {
            return false;
        } else {
            return true;
        }
    }



    // ==============================================
    /**
     *  
     * This Part for inputs validity Errors
     **/
    function nameValidityError($inputField)
    {
        // check if empty
        $this->emptyFieldError($inputField);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $this->test_input($_POST[$inputField]))) {
            array_push($this->errors[$inputField], $this->model::ERR_NAME);
        }
    }

    function emailValidityError($inputField)
    {
        // check if empty
        $this->emptyFieldError($inputField);
        // check if e-mail address is well-formed
        if (!filter_var($this->test_input($_POST[$inputField]), FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors[$inputField], $this->model::ERR_EMAIL_VALIDATE);
        }
        if ($this->sql::SQL_ENV == 'sqlite' && !$this->sqliteTestInput($inputField)) {
            array_push($this->errors[$inputField], str_replace('(())', 'Email', $this->model::ERR_UNIQUE));
        }
    }




    function usernameValidityError($inputField)
    {
        if ($this->sql::SQL_ENV == 'sqlite' && !$this->sqliteTestInput($inputField)) {
            array_push($this->errors[$inputField], str_replace('(())', 'Username', $this->model::ERR_UNIQUE));
        }
    }




    function passwordValidityError($inputField)
    {
        // check if empty
        $this->emptyFieldError($inputField);

        //check length
        $this->checkFieldLength($inputField);

        // check strength
        if ($this->passwordStrength()) {
            array_push($this->errors[$inputField], $this->model::ERR_STRENGTH);
        }
    }





    function confirmPasswordValidityError($inputField1, $inputField2)
    {
        // check if empty
        $this->emptyFieldError($inputField1);
        // check confirmation
        if ($_POST[$inputField1] !== $_POST[$inputField2]) {
            array_push($this->errors[$inputField1], $this->model::ERR_MATCH_PASSWORD);
        }
    }



    // ====================================================
    /**
     *  
     * This Part for handeling register form
     **/
    function ifClassError($inputName)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($this->errors[$inputName])) {
                echo 'is-invalid';
            }
        }
    }

    function errorMessage($inputName)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($this->errors[$inputName])) {
                return $this->errors[$inputName][0];
            }
        }
    }

    function inputValue($inputName)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $_POST[$inputName];
        }
    }



    // =========================================================
    /**
     *  
     * This Part for check input field Tools
     **/

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function emptyFieldError($inputField)
    {
        // check if empty
        if (empty($_POST[$inputField])) {
            array_push($this->errors[$inputField], $this->model::ERR_REQUIRED);
        }
    }

    function checkFieldLength($inputField)
    {
        //check length
        if (strlen($_POST[$inputField]) < 6) {
            array_push($this->errors[$inputField], $this->model::ERR_LENGTH);
        }
    }

    function passwordStrength()
    {
        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
        $lowercase = preg_match('@[a-z]@', $_POST['password']);
        $number    = preg_match('@[0-9]@', $_POST['password']);
        $specialChars = preg_match('@[^\w]@', $_POST['password']);
        if (!$uppercase || !$lowercase || !$number || !$specialChars) {
            return true;
        } else {
            return false;
        }
    }
}