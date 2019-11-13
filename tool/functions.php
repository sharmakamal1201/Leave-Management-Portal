
<?php
    session_start();
    $host = 'localhost';
    $database_name = 'mongo1';
    $connection = new MongoClient();
    $database = $connection->$database_name;

    $user = 'root';
    $pass = '';
    $mySql_db = 'testdb';
    $mySql_db = new mysqli('localhost',$user,$pass,$mySql_db);
    if ($mySql_db->connect_error) {
        die("Connection failed: " . $mySql_db->connect_error);
    }
?>