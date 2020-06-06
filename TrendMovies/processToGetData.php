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
$statement = "INSERT INTO moviesofweek(id_movie,title, popularity,vote_count,poster_path,Date_Of_read,position_in_week) 
VALUES(:id_movie,:title, :popularity, :vote_count,:poster_path, :Date_Of_read, :position_in_week)";

// to watch error at statment in pdo
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//calculate the number of weeks betwen initial date and current date
$data_initial = new DateTime('2020-05-24');
$date_actual = new DateTime();
$interval = $data_initial->diff($date_actual);




//to get data into array
foreach($movies->results as $movie){
    
    $position_in_week++;;
    $id_movie = $movie->id;
    $nameOfMovie = $movie->title;
    $popularity = $movie->popularity;
    $vote_count = $movie->vote_count;
    $poster_path = $movie->poster_path;

    $Date_Of_read = date("Y-m-d");


    try {      
        
        $stm = $conn->prepare($statement);
    
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