<?php
//Create a connection to the database
//DB, UN, Pass, DB
          mysql_connect('209.129.8.3', '47924', '47924cis12');
          mysql_select_db('47924');
          //mysql_connect('localhost', 'root', '');
          //mysql_select_db('test');
//Query the database

        $query="INSERT INTO `ac2292777_entity_movie2` (`movie_id`,`movie_name`,`movie_rating`) 
        VALUES ";
        $records=50;
        for($i=1;$i<=$records;$i++){

        $query.="('NULL'".",";
        $query.="'Movie ".rand(1,2000)."',";
        $query.=rand(1,4).")";

        if($i!=$records)$query.=",";
        }
        $rs = mysql_query($query);

if(! $rs )
{
  die('Could not enter data: ' . mysql_error());
}

?>


