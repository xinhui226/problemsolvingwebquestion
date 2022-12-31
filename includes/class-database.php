<?php

class Database
{

    public function __construct()
    {
        return new PDO(
            'mysql:host=devkinsta_db;dbname=problem_solving_web_question', // instruction: change the host to devkinsta_db and insert your own database name
            'root', 
            'cD4FYhCb9HPk9bc0' // instruction: change this to your database password
        );
    }

}