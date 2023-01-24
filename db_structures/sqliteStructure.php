<?php

namespace db_structure;

use SQLEnv;

include_once(__DIR__ . '/../SQLEnv.php');

class sqliteStructure extends \SQLENV
{
    public SQLEnv $sqlite;

    /**
     * [Description for __construct]
     * Creating an instance for SQLEnv class
     * 
     * Created at: 10/1/2022, 6:27:15 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function __construct()
    {
        $this->sqlite = new SQLEnv();
    }



    /**
     * [Description for showTables]
     * using from cli
     *
     * @return mixed
     * 
     * Created at: 10/1/2022, 6:05:57 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function showTables()
    {
        $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY rootpage";
        $pdo = $this->sqlite->sqlitePDO_Connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        if ($stmt) {
            echo PHP_EOL;
            echo "Tables Are:" . PHP_EOL;
            echo "-------------------------------" . PHP_EOL;
            $tables = $stmt->fetchAll();
            if (!empty($tables)) {
                // var_dump($tables);
                if (count($tables) === 1 && $tables[0]['name'] === 'sqlite_sequence') {
                    echo "There is no tables in this Dbase Except <<sqlite_sequence>>";
                }
                foreach ($tables as $table) {
                    if ($table['name'] === 'sqlite_sequence') continue;
                    $name = "Name: " . $table['name'] . PHP_EOL .
                        "-------------------------------" . PHP_EOL;
                    echo $name;
                }
            } else {
                echo "There is no tables in this Dbase";
            }
        }
    }



    /**
     * [Description for createTableWithQuery]
     * Create table with full query
     *
     * @param string $qur query
     * 
     * @return mixed
     * 
     * Created at: 10/1/2022, 6:44:51 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function createTableWithQuery(string $qur)
    {
        $pdo = $this->sqlite->sqlitePDO_Connect();

        /* to get the table name from query */
        $pos1 = 27;
        $pos2 = strpos($qur, ' (');
        $length = $pos2 - $pos1;
        $tname = substr($qur, $pos1, $length);
        $creation = $pdo->prepare($qur)->execute();
        if ($creation) {
            echo 'Table <<' . $tname . '>> is Created! And ready to use' . PHP_EOL;
        } else {
            echo 'Table Creation Failed';
        }
    }


    /**
     * [Description for createTableWithColumns]
     * full structured table using cli
     *
     * @param string $name Table name
     * @param array $columns associated array
     * @param string $primary PRIMARY KEY
     * @param array $forgin FOREIGN KEY
     * 
     * @return mixed
     * 
     * Created at: 10/1/2022, 6:07:10 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function createTableWithColumns(string $name, array $columns, string $primary, array $forgin = [])
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
        $this->createTableWithQuery($qur);
    }



    /**
     * [Description for showTableStructure]
     * Show specific table structure
     *
     * @param string $tablename
     * 
     * @return mixed Table Structure
     * 
     * Created at: 10/1/2022, 6:39:25 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function showTableStructure(string $tablename)
    {
        $query = "SELECT sql FROM sqlite_master WHERE type='table' AND tbl_name='$tablename'";
        $pdo = $this->sqlite->sqlitePDO_Connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        if ($stmt) {
            $table = $stmt->fetch();
            $struct = substr($table['sql'], strpos($table['sql'], '(') + 1, -1);
            $structArray = explode(',', $struct);
            echo PHP_EOL . "Table <<$tablename>> Structure:" . PHP_EOL . '---------------' . PHP_EOL . PHP_EOL;
            foreach ($structArray as  $value) {
                echo $value . PHP_EOL . '---------------' . PHP_EOL;
            }
        }
    }



    /**
     * [Description for dropTable]
     * dropping (delete) specific table from db
     *
     * @param string $tablename Table name
     * 
     * @return mixed
     * 
     * Created at: 10/1/2022, 6:40:22 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function dropTable(string $tablename)
    {
        $prompt = readline("Are You Sure You want to DROP Table <<$tablename>> from Dbase SQLite ?
        : ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            $query = "DROP TABLE IF EXISTS $tablename";
            $pdo = $this->sqlite->sqlitePDO_Connect();
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            if ($stmt) {
                echo "Table <<$tablename>> was Droped Successfuly";
            } else {
                echo 'Operation Failed!';
            }
        } else {
            echo PHP_EOL . 'Drop Operation was Canceld ..' . PHP_EOL;
        }
    }


    /**
     * [Description for truncateTable]
     * Truncate (empty not delete) specific table
     *
     * @param string $table table name
     * 
     * @return mixed
     * 
     * Created at: 10/1/2022, 6:41:33 AM (Africa/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function deleteAllCol_Table(string $table)
    {
        $prompt = readline("Are You Sure You want to Delete All Columns from Table <<$table>> from Dbase SQLite ?
        : ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            /* instead of TRUNCATE TABLE $table */
            $query = "DELETE FROM '$table'";
            $pdo = $this->sqlite->sqlitePDO_Connect();
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            if ($stmt) {
                echo "Table <<$table>> hass Truncated succssefuly";
            }
        } else {
            echo PHP_EOL . 'Truncate Operation was Canceld' . PHP_EOL;
        }
    }



    /**
     * [Description for truncateTable]
     *
     * @param string $table
     * 
     * @return mixed
     * 
     * Created at: 10/14/2022, 8:27:56 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function truncateTable(string $table)
    {
        $prompt = readline("Are You Sure You want to Delete All Columns from Table <<$table>> from Dbase SQLite ?
        : ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            /* instead of TRUNCATE TABLE $table */
            $query = "DELETE FROM '$table'";
            $query2 = "delete from sqlite_sequence where name= ?";
            $pdo = $this->sqlite->sqlitePDO_Connect();
            $stmt = $pdo->prepare($query);
            $stmt2 = $pdo->prepare($query2);
            $stmt->execute();
            $stmt2->execute([$table]);
            if ($stmt && $stmt2) {
                echo "Table <<$table>> hass Truncated succssefuly";
            }
        } else {
            echo PHP_EOL . 'Truncate Operation was Canceld' . PHP_EOL;
        }
    }


    function truncateTable2(string $table) //deprecated not working
    {
        $prompt = readline("Are You Sure You want to Truncate Table <<$table>> from Dbase SQLite ?
        : ");
        strtolower($prompt);
        if ($prompt == 'y' || $prompt == 'yes') {
            $query = "SELECT sql FROM sqlite_master WHERE type='table' AND tbl_name='$table'";
            $pdo = $this->sqlite->sqlitePDO_Connect();
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            if ($stmt) {
                $structqur = $stmt->fetch();
                $newTableQuer = $structqur['sql'];
                //echo $newTableQuer;
            }
        } else {
            echo PHP_EOL . 'Truncate Operation was Canceld' . PHP_EOL;
        }
    }
}