<?php

class Manager
{
    protected function dbConnect(){
        $db = new PDO('mysql:host=localhost;dbname=mvc_blog;charset=UTF8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Enable display of requests errors
        return $db;
    }
}
