<?php

class Db {

    private $dbhost = "sql11.freemysqlhosting.net";
    private $dbuser = "sql11498643";
    private $dbpass = "eQ8DSyDIg5";
    private $dbname = "sql11498643";
	private $sitekey = "XrdfGtrg98456";

    public function connect() {
        $mysql_connection = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8";
        $connection = new PDO($mysql_connection,$this->dbuser,$this->dbpass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }

}