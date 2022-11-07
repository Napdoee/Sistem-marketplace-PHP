<?php 

require_once "../database/config.php";

global $conn;

function query($sql){
    if(!$sql){
        return printf("Error not found sql"); 
    }
    $resArr = array();
    $query = $sql;
    $result = mysqli_query($GLOBALS['conn'], $query);
    while($row  = mysqli_fetch_assoc($result)){
        $resArr[] = $row;
    }
return $resArr;
}

?>