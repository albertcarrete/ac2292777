<?php
//Create a connection to the database
//DB, UN, Pass, DB
          mysql_connect('209.129.8.3', '47924', '47924cis12');
          mysql_select_db('47924');
          //mysql_connect('localhost', 'root', '');
          //mysql_select_db('test');
//Query the database
        $query="SELECT `movie_id`, 
		        `name`, `studio`, `release_date`, 
				`rating_id`, `duration` 
				FROM `ml1150258_entity_movie` 
				AS `ml1150258_entity_movie`;";
        $rs = mysql_query($query);
        echo "<table border='1'>";
        while($re = mysql_fetch_array($rs)){
                  echo "<tr><td>".$re['name']."</td>";
                  echo "<td>".$re['studio']."</td>";
                  echo "<td>".$re['release_date']."</td>";
                  echo "<td>".$re['duration']."</td></tr>";
        }
        echo "</table>";
?>