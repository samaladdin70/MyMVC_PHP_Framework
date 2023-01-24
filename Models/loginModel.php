<?php

namespace Models;

use GlobalEnv;
use SQLEnv;

include_once(__DIR__ . '/../GlobalEnv.php');
include_once(__DIR__ . '/../SQLEnv.php');

class loginModel extends Model
{
    public array $errors = [];
    public array $output = [];
    public Model $model;
    public SQLEnv $sql;
    public GlobalEnv $tool;

    function __construct()
    {
        $this->model = new Model();
        $this->tools = new GlobalEnv();
        $this->sql = new SQLEnv();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors['email'] = [];
            $this->errors['password'] = [];

            $this->fieldsError('email');

            if (!$this->isErrors()) {
                $this->handleLogin();
            } else {
                $this->output = [];
            }
        }
    }

    function fieldsError(string $input, string $table = 'users')
    {
        $query = "SELECT * FROM $table WHERE email = ?";
        $values = [$this->model->email];

        if ($this->sql::SQL_ENV == 'sqlite') {
            $connect = $this->sql->sqlitePDO_Connect();
        } elseif ($this->sql::SQL_ENV == 'mysql') {
            $connect = $this->sql->mysqlPDO_Connect();
        }

        $stmt = $connect->prepare($query);
        $stmt->execute($values);
        if ($stmt) {
            $output = $stmt->fetch();
            if (empty($output)) {
                array_push($this->errors[$input], $this->model::NOT_EXIST);
            } else {
                $this->output = $output;
                $this->output['remember'] = $this->model->remember;

                if ($this->output['password'] !== $this->tools->code($this->model->password)) {
                    array_push($this->errors['password'], $this->model::WRONG_PASS);
                } else {
                    $this->output['password'] = "done";
                }
            }
        }
    }


    function isErrors()
    {
        if (empty($this->errors['email']) && empty($this->errors['password'])) {
            return false;
        } else {
            return true;
        }
    }

    function handleLogin()
    {
        if ($this->output['remember'] === 'on') {
            # set cookies...
            setcookie(
                "userId",
                $this->tools->code($this->output['id']),
                time() + (60 * 60 * 24 * 365 * 10)
            );
            setcookie(
                "firstname",
                $this->output['firstname'],
                time() + (60 * 60 * 24 * 365 * 10)
            );
            setcookie(
                "lastname",
                $this->output['lastname'],
                time() + (60 * 60 * 24 * 365 * 10)
            );
            setcookie(
                "username",
                $this->output['username'],
                time() + (60 * 60 * 24 * 365 * 10)
            );
            // for none mvc we add "/" for cookies as an optional which is root path to pass cookies from any path at server
        } else {
            # set session...
            session_start();
            $_SESSION["userId"] = $this->tools->code($this->output["id"]);
            $_SESSION["firstname"] = $this->output["firstname"];
            $_SESSION["lastname"] = $this->output["lastname"];
            $_SESSION["username"] = $this->output["username"];
        }

        //////////////////////////
        // session_unset();
        echo '<div style="position:absolute; top:75px; right:-10px; z-index:100; width:300px;" class="p-4 d-flex justify-content-end">
        <pre class="bg-dark text-warning p-2 rounded" style=" word-wrap: break-word;">';
        var_dump($this->output);
        echo '</pre>
        </div>';
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
}


/* echo '<div style="position:absolute; top:75px; right:-10px; z-index:100; width:300px;" class="p-4 d-flex justify-content-end">
        <pre class="bg-dark text-warning p-2 rounded" style=" word-wrap: break-word;">';
                var_dump($output);
                echo '</pre>
        </div>'; */