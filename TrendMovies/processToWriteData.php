<!DOCTYPE html>
<head>
    <title>MoviesOfWeeks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>

        .containerOfMovie{

        float: left;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-right: 10px;
        margin-left: 10px;    
        font-family:Arial, Helvetica, sans-serif;
        text-align: center;
        }
        #postOfMovie{
          border: 10px solid #ccc;
        }

        #positionWeek{
          font-family: Arial, Helvetica, sans-serif;
        }

</style>
</head>
<body>
<div class="jumbotron text-center">
  <h1>Movies Of Week</h1>
  <p>Below we have the 20 most watched movies per week:</p> 
</div>
<?php
include_once 'database.php';

$date=@$_REQUEST['data'];
if(!isset($date)){
  $date="2020-05-24";
}


$sql1 = "SELECT DISTINCT Date_Of_read FROM moviesofweek";
foreach ($conn->query($sql1) as $row) {

  print "<h2><a href='processToWriteData.php?data=".$row['Date_Of_read']."'>". $row['Date_Of_read']." </a> |</h2>";
  
  $sql2 = "SELECT title, popularity, poster_path, id_movie, position_in_week, Date_Of_read  
FROM moviesofweek where Date_Of_read ='" .$date. "' order by position_in_week";
}


//get data from moviesOfWeeks table 
foreach ($conn->query($sql2) as $row) {
    $titleOfMovie = $row['title'];
    $popularityOfMovie = $row['popularity'];
    $poster_path = $row['poster_path'];
    $id_movie = $row['id_movie'];
    $position_week = $row['position_in_week'];
?>

<div class="containerOfMovie">
  <div id="postOfMovie" style="border-radius: 30px"><img src="<?php echo "https://image.tmdb.org/t/p/w500/".$poster_path;?>"></div>
  <div id="titleOfMovie">Title: <?php echo $titleOfMovie;?></div>
  <div id="popularityOfMovie">Popularity: <?php echo $popularityOfMovie;?></div>
  <div id="positionWeek">Position_week: <?php echo $position_week; ?></div>
  <div><a href="like.php?id_movie=<?php echo $id_movie;?>" target="_blank">like</a></div>
</div>

<?php }?>

</body>
</html>