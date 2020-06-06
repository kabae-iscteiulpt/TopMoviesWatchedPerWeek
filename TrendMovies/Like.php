<?php

include_once 'database.php';

$id_movie=@$_REQUEST['id_movie'];
//echo $id_movie;

$statement = "INSERT INTO liked_movie(id_movie,ip_user) 
VALUES(:id_movie,:ip_user)";

// to watch error at statment in pdo
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ipAddressOfUser=$_SERVER['REMOTE_ADDR'];

echo "the movie the id: ".$id_movie." get like from user of ip_address: ".$ipAddressOfUser;
 /*   try {      
        
        $stm = $conn->prepare($statement);
    
        $stm->bindParam(':id_movie',$id_movie);
        $stm->bindParam(':ip_user',$ipAddressOfUser);

        $stm->execute();

        
    } catch(PDOException $e) {
        echo "ERROOO: ".$e->getMessage()."<br>";
    }
*/
?>