<?php

$host = 'localhost'; // PostgreSQL host
$dbname = 'rendezvous'; 
$username = 'postgres'; 
$password = 'Isen44'; 

$databaseConnected = false;

try {
    // Create a new PDO instance for PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $databaseConnected = true;
} 
catch (PDOException $e) {
    //nothing to see here :( the site will modify itself if the database is not connected !
}

/* 
$Table = new db($conn,'tableName','primaryKey');
 And then you can do request :
$result = $Table->request($truc); (read the doc)
*/


$Doctors = new db($conn, 'doctors', 'id',['id','firstname','lastname','email','phone','password','postcode','expertise_id']);
$Patients = new db($conn, 'patients', 'id', ['id','firstname','lastname','email','phone','password']);
$Rendezvous = new db($conn, 'rendezvous', 'id', ['id','date','start','end','patient_id','doctor_id','location_id']);
$Expertise = new db($conn, 'expertise', 'id',['id','name']);
$Locations = new db($conn, 'locations', 'id',['id','name','postcode']);


?> 


