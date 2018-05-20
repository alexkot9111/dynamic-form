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

    function __construct(){ 
        $dbLink = mysql_connect('localhost', 'root', '') or die ('Не удалось соединиться: ' . mysql_error());
        mysql_select_db('dynamic_form') or die ('Не удалось выбрать базу данных');

        if ( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'users'")) !== 1 ) {
            $this->createTable();
        }
    }

    /**
     * Create user table
     */
    public function createTable(){
        $query = "CREATE TABLE users (
            id int NOT NULL AUTO_INCREMENT,
            email text,
            name text,
            territory bigint,
            PRIMARY KEY (id)
        );";
        $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
    }
}