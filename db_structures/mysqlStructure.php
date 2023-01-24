<?php

namespace db_structure;

include_once('' . __DIR__ . '/../SQLEnv.php');

use SQLEnv;

/**
 * [Description DbCreations]
 */
class mysqlStructure extends SQLEnv
{
    /**
     * [Description for $mysql]
     *
     * @var SQLEnv class object
     */
    public SQLEnv $mysql;



    /**
     * [Description for __construct]
     * create an instance for $QLEnv object to use its properties
     * and methods
     * 
     * Created at: 9/25/2022, 7:49:32 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function __construct()
    {
        $this->mysql = new SQLEnv();
    }



    /**
     * [Description for showDbs]
     *
     * @return mixed show Data Bases
     * 
     * Created at: 9/27/2022, 8:07:49 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function showDbs()
    {
        $query = "SHOW DATABASES";
        $dsn = "mysql:host=" . $this->mysql->mysqlHost . ";";
        try {
            $pdo = new \PDO($dsn, $this->mysql->mysqlUsername, $this->mysql->mysqlPassword, $this->mysql->PDO_Options());
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        if ($stmt) {
            $dbases = $stmt->fetchAll();
            if (!empty($dbases)) {
                echo PHP_EOL;
                echo 'Dbases are:' . PHP_EOL;
                echo '---------------------' . PHP_EOL;
                foreach ($dbases as $dbase) {
                    echo $dbase['Database'] . ' | ';
                }
                echo PHP_EOL . '---------------------' . PHP_EOL;
            } else {
                echo 'There is no dbases';
            }
        }
    }



    /**
     * [Description for showtables]
     *
     * @param string $dbname DB name
     * 
     * @return mixed
     * 
     * Created at: 9/28/2022, 12:27:12 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function showtables(string $dbname = '')
    {
        if ($dbname === '') $dbname = $this->mysql->mysqlDbname;
        $query = "SHOW FULL TABLES";

        $pdo = $this->mysql->mysqlPDO_Connect($dbname);
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        if ($stmt) {
            echo PHP_EOL;
            echo "Tables in (($dbname)) Are:" . PHP_EOL;
            echo "-------------------------------" . PHP_EOL;
            $tables = $stmt->fetchAll();
            if (!empty($tables)) {
                foreach ($tables as $table) {
                    echo "Name: " . $table['Tables_in_' . $dbname . ''] . " | type: " . $table['Table_type'] . "" . PHP_EOL;
                    echo "-------------------------------" . PHP_EOL;
                }
            } else {
                echo "There is no tables in this (($dbname)) Dbase";
            }
        }
    }



    /**
     * [Description for createDB]
     * Create new Database if not exists
     *
     * @param string $dbName Database name you want to creat
     * 
     * @return mixed
     * 
     * Created at: 9/25/2022, 3:37:15 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function createDB($dbName)
    {
        $query = "CREATE DATABASE  IF NOT EXISTS $dbName CHARACTER SET utf8 COLLATE utf8_general_ci";
        $dsn = "mysql:host=" . $this->mysql->mysqlHost . ";";
        try {
            $pdo = new \PDO($dsn, $this->mysql->mysqlUsername, $this->mysql->mysqlPassword, $this->mysql->PDO_Options());
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $creation = $pdo->prepare($query)->execute();
        if ($creation) {
            echo 'Dbase ((' . $dbName . ')) is Created! And ready to use' . PHP_EOL;
        }
    }




    /**
     * [Description for createTable]
     * Create new table inside Existed Dbase
     *
     * @param string $qur query for create specified table
     * @param string $dbname 
     * 
     * @return mixed
     * 
     * Created at: 9/25/2022, 7:53:01 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function createTableWithQuery($qur, $dbname = '')
    {
        $pdo = $this->mysql->mysqlPDO_Connect($dbname);

        /* to get the table name from query */
        $pos1 = 27;
        $pos2 = strpos($qur, ' (');
        $length = $pos2 - $pos1;
        $tname = substr($qur, $pos1, $length);
        $creation = $pdo->prepare($qur)->execute();
        if ($creation) {
            echo 'Table <<' . $tname . '>> is Created! And ready to use' . PHP_EOL;
        }
    }




    /**
     * [Description for createTableWithColumns]
     *
     * @param string $name table name
     * @param array $columns Assciative array with string key and array value
     * like: 
     * ['colname1'=>['prop1', 'prop2', 'prop3', ...], 'colname2 =>[....], ...']
     * @param string $primary for PRIMARY KEY like: '(colname)'
     * @param array $forgin indexed array like: 
     * ['colnameHere', 'anotherTableName(colnameThere)']
     * @param string $dbname DB name 
     * 
     * @return mixed
     * 
     * Created at: 9/27/2022, 2:32:54 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function createTableWithColumns(string $name, array $columns, string $primary, array $forgin = [],  $dbname = '')
    {
        $column = '';
        foreach ($columns as $col_name => $props) {
            $column .= $col_name . " ";
            foreach ($props as  $value) {
                $column .= $value . " ";
            }
            $column .= ", ";
        }
        $column .= " PRIMARY KEY ($primary)";
        if (!empty($forgin)) {
            $column .= ", FOREIGN KEY (" . $forgin[0] . ") REFERENCES " . $forgin[1] . "";
        }
        $qur = "CREATE TABLE IF NOT EXISTS $name ( $column );";
        $this->createTableWithQuery($qur, $dbname);
    }

    /**
     * [Description for dropTable]
     *
     * @param string $table
     * @param string $dbname
     * 
     * @return mixed
     * 
     * Created at: 9/29/2022, 5:21:28 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function dropTable(string $table, string $dbname = '')
    {
        if ($dbname === '') $dbname = $this->mysql->mysqlDbname;
        $prompt = readline("Are You Sure You want to DROP Table <<$table>> from Dbase (($dbname)) ?" . PHP_EOL . ": ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            $query = "DROP TABLE $table";
            $prepareDrop = $this->mysql->securePurpose($query, $dbname);
            $drop = $prepareDrop->execute();
            if ($drop) {
                echo "Table <<$table>> hass Droped succssefuly";
            }
        } else {
            echo 'Operation Canceld' . PHP_EOL;
        }
    }



    /**
     * [Description for truncateTable]
     *
     * @param string $table
     * @param string $dbname
     * 
     * @return mixed
     * 
     * Created at: 9/29/2022, 5:28:25 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function truncateTable(string $table, string $dbname = '')
    {
        if ($dbname === '') $dbname = $this->mysql->mysqlDbname;
        $prompt = readline("Are You Sure You want to Truncate Table <<$table>> from Dbase (($dbname)) ?" . PHP_EOL . ": ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            $query = "TRUNCATE TABLE $table";
            $prepareTRUNCATE = $this->mysql->securePurpose($query, $dbname);
            $truncate = $prepareTRUNCATE->execute();
            if ($truncate) {
                echo "Table <<$table>> hass Truncated succssefuly";
            }
        } else {
            echo 'Operation Canceld' . PHP_EOL;
        }
    }
}