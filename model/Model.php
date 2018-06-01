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
    public static $dbLink;

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

        $dbLink = self::$dbLink = mysqli_connect($ini['host'], $ini['db_user'], $ini['db_password']) or die ('Не удалось соединиться!');

        /* Check encoding utf8 */
        if (!$dbLink->set_charset("utf8")) {
            printf("Ошибка при загрузке набора символов utf8: %s\n", $dbLink->error);
            exit();
        }

        // Check if db exist
        if (mysqli_select_db($dbLink, $ini['db_name'])){
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
        $result = mysqli_query(self::$dbLink, $query) or die('Не удалось создать базу данных: ' . mysqli_error(self::$dbLink));

        mysqli_select_db(self::$dbLink, $db_name);
        $this->checkTables($tables);
    }

    /**
     * Check if tables exist
     */
    public function checkTables($tables){
        foreach ($tables as $table_key => $table_func) {
            if ( mysqli_num_rows(mysqli_query(self::$dbLink, "SHOW TABLES LIKE '$table_key'")) !== 1 ) {
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
                if(!mysqli_query(self::$dbLink, $templine)){
                    print('Не удалось создать таблицу: ' . mysqli_error(self::$dbLink));
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
        $result = mysqli_query(self::$dbLink, $query) or die('Не удалось создать таблицу: ' . mysqli_error(self::$dbLink));
    }
}