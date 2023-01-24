<?php

namespace migrations;

use db_structure\mysqlStructure;

include_once(__DIR__ . '/../db_structures/mysqlStructure.php');

/* -------------------------------------------------------------- */


$create = new mysqlStructure();
$create->createDB('my_mvc');

$qurTable1 = "CREATE TABLE IF NOT EXISTS Persons (
Personid int NOT NULL AUTO_INCREMENT,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Age int,
PRIMARY KEY (Personid)
);";

/* for dbname in class SQLEnv as a property */
//$create->createTableWithQuery($qurTable1);

/* for custom dbname not in the class SQLEnv */
//$create->createTableWithQuery($qurTable1, 'my_mvc');



/* for dbname in class SQLEnv as a property no need to pass an array for forgin key if table has no forgin key */
// $create->createTableWithColumns('Persons', ['Personid' => ['int', 'NOT NULL', 'AUTO_INCREMENT'], 'LastName' => ['varchar(255)', 'NOT NULL'], 'FirstName' => ['varchar(255)'], 'Age' => ['int']], 'Personid',);

/* for custom dbname not in the class SQLEnv must pass before it an array for forgin key but if table has no gorgin key we pass empty array [] */
// $create->createTableWithColumns('Persons', ['Personid' => ['int', 'NOT NULL', 'AUTO_INCREMENT'], 'LastName' => ['varchar(255)', 'NOT NULL'], 'FirstName' => ['varchar(255)'], 'Age' => ['int']], 'Personid', [], 'my_mvc');

// $create->createTableWithColumns('Posts', ['postid' => ['int', 'NOT NULL', 'AUTO_INCREMENT'], 'posts' => ['varchar(255)', 'NOT NULL'], 'user' => ['int'], 'Time' => ['DATE', 'NOT NULL', 'DEFAULT CURRENT_TIMESTAMP']], 'postid', ['user', 'Persons(Personid)'], 'my_mvc');

$tablename = 'users';
$col1 = 'id';
$col1_options = ['int', 'NOT NULL', 'AUTO_INCREMENT'];
$col2 = 'firstname';
$col2_options = ['varchar(32) NOT NULL'];
$col3 = 'lastname';
$col3_Options = ['varchar(32) NOT NULL'];
$col4 = 'username';
$col4_options = ['varchar(32) NOT NULL'];
$col5 = 'email';
$col5_options = ['text NOT NULL'];
$col6 = 'password';
$col6_options = ['text NOT NULL'];
$col7 = 'time_stamp';
$col7_options = ['datetime NOT NULL', 'DEFAULT CURRENT_TIMESTAMP'];
$col8 = 'activated';
$col8_options = ['BOOLEAN NULL'];
$primary = 'id';
$columns = [
    $col1 => $col1_options, $col2 => $col2_options,
    $col3 => $col3_Options, $col4 => $col4_options,
    $col5 => $col5_options, $col6 => $col6_options,
    $col7 => $col7_options, $col8 => $col8_options
];

// $create->createTableWithColumns($tablename, $columns, $primary);

// $create->dropTable('users');

$create->showDbs();
$create->showtables();

$create->truncateTable('users');
$create->showtables();










/* echo $create->mysql->mysqlHost;
echo 'localhost'; */

/* 
$queryCreateTable = "CREATE TABLE Persons (
Personid int NOT NULL AUTO_INCREMENT,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Age int,
PRIMARY KEY (Personid)
);";

$postsTableStructure = "CREATE TABLE IF NOT EXISTS $postsTableName (
    id int NOT NULL AUTO_INCREMENT,
    post_user_id int,
    caption char (32) NOT NULL,
    category char (32),
    price char (32),
    image text NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (post_user_id) REFERENCES users(id)
);";

$followsTableStructure = "CREATE TABLE IF NOT EXISTS $followsTableName (
    id int NOT NULL AUTO_INCREMENT,
    follower int NOT NULL,
    followed int NOT NULL,
    block int,
    PRIMARY KEY (id),
    FOREIGN KEY (follower) REFERENCES users(id),
    FOREIGN KEY (followed) REFERENCES users(id)
);";

*/