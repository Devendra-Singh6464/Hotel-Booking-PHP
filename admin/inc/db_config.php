<?php

$serverName = "localhost";
$userName = "root";
$password = "root";
$database = "hotel_db";

$conn = mysqli_connect($serverName, $userName, $password, $database);
if(!$conn){
    die("Connection failed: ". mysqli_connect_errno());
}
// echo("Connection Successfull");

function filteration($data){
    foreach($data as $key => $value){
        $data[$key] = trim($value);
        $data[$key] = stripcslashes($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

function select($sql, $values, $datatypes){
    $conn = $GLOBALS['conn'];
    if($prp = mysqli_prepare($conn,$sql)){
        mysqli_stmt_bind_param($prp, $datatypes, ...$values);
        if(mysqli_stmt_execute($prp)){
            $res = mysqli_stmt_get_result($prp);
            mysqli_stmt_close($prp);
            return $res;
        }
        else{
            mysqli_stmt_close($prp);
            die("Query connot be exxcuted - Select");
        }
    }
    else{
        die("Query connot be Prepare - select");
    }
}

function update($sql, $values, $datatypes){
    $conn = $GLOBALS['conn'];
    if($stmt = mysqli_prepare($conn,$sql))
    {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if(mysqli_stmt_execute($stmt))
        {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query connot be executed - Update");
        }
    }
    else{
        die("Query connot be Prepare - update");
    }
}

?>