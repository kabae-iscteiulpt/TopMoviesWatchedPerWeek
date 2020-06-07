<?php

include_once 'database.php';

echo "################################################";
echo "getting data from API and insert that into DB";
echo "################################################";

// API
$url = "https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=7e55536303c36aa930f747c1534556cf";

//to get the data from api
$movies = json_decode(file_get_contents($url));

//statment used to insert into table moviesofweek
$statement = "INSERT INTO moviesofweek(id,id_movie,title, popularity,vote_count,poster_path,Date_Of_read,position_in_week) 
VALUES(:id,:id_movie,:title, :popularity, :vote_count,:poster_path, :Date_Of_read, :position_in_week)";

// to watch error at statment in pdo
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$position_in_week = 0;
$id=40;

//to get data into array
foreach($movies->results as $movie){
    
    $id++;
    $id_movie = $movie->id;
    $nameOfMovie = $movie->title;
    $popularity = $movie->popularity;
    $vote_count = $movie->vote_count;
    $poster_path = $movie->poster_path;
    $Date_Of_read = date("Y-m-d");
    $position_in_week++;
   

    try {      
        
        $stm = $conn->prepare($statement);
    
        $stm->bindParam(':id',$id);
        $stm->bindParam(':id_movie',$id_movie);
        $stm->bindParam(':title',$nameOfMovie);
        $stm->bindParam(':popularity',$popularity);
        $stm->bindParam(':vote_count',$vote_count);
        $stm->bindParam(':poster_path',$poster_path);
        $stm->bindParam(':Date_Of_read',$Date_Of_read);
        $stm->bindParam(':position_in_week',$position_in_week);

        $stm->execute();

        
    } catch(PDOException $e) {
        echo "ERROOO: ".$e->getMessage()."<br>";
    }
}
echo "################################################";
echo "Finished of get data and insert into DB";
echo "################################################";
?>