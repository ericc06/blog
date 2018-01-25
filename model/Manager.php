<?php

namespace EricCodron\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        require_once("config.php");

        $db = new \PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', ''.$db_user.'', ''.$db_pass.'');
        return $db;
    }
}