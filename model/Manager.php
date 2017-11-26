<?php

namespace EricCodron\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p5;charset=utf8', 'root', '');
        return $db;
    }
}