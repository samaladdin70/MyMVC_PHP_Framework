<?php

namespace migrations;

use db_structure\sqliteStructure;

include_once(__DIR__ . '/../db_structures/sqliteStructure.php');

/* ---------------------------------------------------------------- */

$qlite = new sqliteStructure();


/* $query = "CREATE TABLE IF NOT EXISTS users (
	id	INTEGER NOT NULL UNIQUE,
	firstname	TEXT NOT NULL,
	lastname	TEXT NOT NULL,
	username	TEXT UNIQUE,
	email	TEXT NOT NULL UNIQUE,
	password	TEXT NOT NULL,
	verified	INTEGER,
	activated	INTEGER,
	PRIMARY KEY ('id' AUTOINCREMENT)
    );"; */

// $qlite->createTableWithQuery($query);

/* $tablename = 'persons';
$col1 = 'id';
$col1_options = ['INTEGER NOT NULL UNIQUE'];
$col2 = 'name';
$col2_options = ['TEXT NOT NULL'];
$primary = "'id' AUTOINCREMENT";
$col3 = 'forginId';
$col3_options = ['INTEGER NOT NULL'];
$forginKey = [$col3, 'users(id)'];

$columns = [$col1 => $col1_options, $col2 => $col2_options, $col3 => $col3_options]; */

//$qlite->createTableWithColumns($tablename, $columns, $primary, $forginKey);

// $qlite->showTables();

// $qlite->showTableStructure('persons');
// $qlite->dropTable('users');
// $qlite->dropTable('persons');
/* $qlite->dropTable('sqlite_sequence'); // cann't Drop */


$tablename = 'users';
$col1 = 'id';
$col1_options = ['INTEGER NOT NULL UNIQUE'];
$col2 = 'firstname';
$col2_options = ['TEXT NOT NULL'];
$col3 = 'lastname';
$col3_options = ['TEXT NOT NULL'];
$col4 = 'username';
$col4_options = ['TEXT'];
$col5 = 'email';
$col5_options = ['TEXT NOT NULL'];
$col6 = 'password';
$col6_options = ['TEXT NOT NULL'];
$col7 = 'time_stamp';
$col7_options = ['TEXT NOT NULL'];
$col8 = 'verified';
$col8_options = ['INTEGER'];
$col9 = 'activated';
$col9_options = ['INTEGER'];
$columns =
	[
		$col1 => $col1_options, $col2 => $col2_options,
		$col3 => $col3_options, $col4 => $col4_options,
		$col5 => $col5_options, $col6 => $col6_options,
		$col7 => $col7_options, $col8 => $col8_options,
		$col9 => $col9_options
	];
$primary = "'id' AUTOINCREMENT";
// $qlite->createTableWithColumns($tablename, $columns, $primary);

// $qlite->dropTable('users');
// $qlite->dropTable('users');

/* $quer = "CREATE TABLE IF NOT EXISTS users ( id INTEGER NOT NULL UNIQUE , firstname TEXT NOT NULL , lastname TEXT NOT NULL , username TEXT , email TEXT NOT NULL , password TEXT NOT NULL , time_stamp TEXT NOT NULL , verified INTEGER , activated INTEGER ,  PRIMARY KEY ('id' AUTOINCREMENT) )";
$qlite->createTableWithQuery($quer); */

$qlite->showTables();
// $qlite->truncateTable('users');

// $qlite->showTableStructure('users');

/* 
CREATE TABLE "users" (
	"id"	INTEGER NOT NULL UNIQUE,
	"firstname"	TEXT NOT NULL,
	"lastname"	TEXT NOT NULL,
	"username"	TEXT UNIQUE,
	"email"	TEXT NOT NULL UNIQUE,
	"password"	TEXT NOT NULL,
	"verified"	INTEGER,
	"activated"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
)


CREATE TABLE users ( id INTEGER NOT NULL UNIQUE , firstname TEXT NOT NULL , lastname TEXT NOT NULL , username TEXT , email TEXT NOT NULL , password TEXT NOT NULL , time_stamp TEXT NOT NULL , verified INTEGER , activated INTEGER ,  PRIMARY KEY ('id' AUTOINCREMENT) )
*/