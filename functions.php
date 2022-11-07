<?php 
function query($sql){
    include "./database/config.php";

    if(!$sql){
        return printf("Error not found sql"); 
    }
    $resArr = array();
    $query = $sql;
    $result = mysqli_query($conn, $query);
    while($row  = mysqli_fetch_assoc($result)){
        $resArr[] = $row;
    }
return $resArr;
}

?>