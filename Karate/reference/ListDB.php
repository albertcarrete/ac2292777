<?php
//Create a connection to the database
//DB, UN, Pass, DB
          //mysql_connect('209.129.8.3', '47924', '47924cis12');
          //mysql_select_db('47924');
          mysql_connect('localhost', '47924', '47924cis12');
          mysql_select_db('47924');
//Query the database
        $query="SELECT `movie_id` AS 'Movie ID', `movie_name` AS 'Movie Name', `movie_rating` AS 'Movie Rating' FROM `47924`.`ac2292777_entity_movie2` AS `ac2292777_entity_movie2`;";
        $rs = mysql_query($query);
        echo "<table border='1'>";
		    echo "<tr><th>".'Movie ID'."</th>";
            echo "<th>".'Movie Name'."</th>";
            echo "<th>".'Movie Rating'."</th></tr>";
        while($re = mysql_fetch_array($rs)){
                  echo "<tr><td>".$re['Movie ID']."</td>";
                  echo "<td>".$re['Movie Name']."</td>";
                  echo "<td>".$re['Movie Rating']."</td></tr>";
        }
        echo "</table>";
?>