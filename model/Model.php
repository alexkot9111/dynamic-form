<?php

/**
 * Model Class
 *
 * @version 0.1.0
 */ 
class Model { 

    /**
     * @var array $dbLink Database Link
     */
    public $dbLink;

    /**
     * @var array $ini Constants Array
     */
    public static $ini;

    /**
     * @var array $tables Tables Array
     */
    public static $tables;


    function __construct(){ 

        $ini = self::$ini = parse_ini_file('php.ini');

        $tables = self::$tables = array('t_koatuu_tree' => 'Contacts', 'users' => 'Users');

        $dbLink = mysql_connect($ini['host'], $ini['db_user'], $ini['db_password']) or die ('Не удалось соединиться: ' . mysql_error());

        // Check if db exist
        if (mysql_select_db($ini['db_name'])){
            $this->checkTables($tables);
        } else {
            $this->createDB();
        }

    }

    /**
     * Create DB
     */
    public function createDB(){
        $db_name = self::$ini['db_name'];
        $tables = self::$tables;
        $query = "CREATE DATABASE $db_name";
        $result = mysql_query($query) or die('Не удалось создать базу данных: ' . mysql_error());

        mysql_select_db($db_name);
        $this->checkTables($tables);
    }

    /**
     * Check if tables exist
     */
    public function checkTables($tables){
        foreach ($tables as $table_key => $table_func) {
            if ( mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table_key'")) !== 1 ) {
                $funcFull = 'create'.$table_func.'Table';
                $this->$funcFull();
            }
        }
    }

    /**
     * Create t_koatuu_tree table
     */
    public function createContactsTable(){

        $filename = './model/dump/protest14.sql';
        $templine = '';
        $fp = fopen($filename, 'r');

        while (($line = fgets($fp)) !== false) {
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
            $templine .= $line;

            if (substr(trim($line), -1, 1) == ';') {
                if(!mysql_query($templine)){
                    print('Не удалось создать таблицу: ' . mysqli_error($dbLink));
                }
                $templine = '';
            }
        }
    }

    /**
     * Create user table
     */
    public function createUsersTable(){
        $query = "CREATE TABLE users (
            id int NOT NULL AUTO_INCREMENT,
            email text,
            name text,
            territory bigint,
            PRIMARY KEY (id)
        );";
        $result = mysql_query($query) or die('Не удалось создать таблицу: ' . mysql_error());
    }
}