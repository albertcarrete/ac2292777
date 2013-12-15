<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Truth Table</title>
</head>

<body>
<h1>Truth Table</h1>
<h5>Author: Albert Carrete <br />
  Course: CIS-12-47924-PHP-Dynamic-Website-Program<br/>
</h5>
<table width="200" border="1">
  <tr>
    <th>x</th>
    <th>y</th>
    <th>!x</th>
    <th>!y</th>
    <th>x&&y</th>
    <th>x||y</th>
    <th>x^y</th>
    <th>x^y^y</th>
    <th>x^y^x</th>
    <th>!(x&&y)</th>
    <th>!x||!y</th>
    <th>!(x||y)</th>
    <th>!x&&!y</th>
  </tr>
  <tr>
  <?php
    //First Row of truth table
  //Declare x and y
  $x=true;$y=true;
  //Output the cells for this row
    echo "<td>".($x?'T':'F')."</td>";
    echo "<td>".($y?'T':'F')."</td>";
  echo "<td>".(!$x?'T':'F')."</td>";
    echo "<td>".(!$y?'T':'F')."</td>";
  echo "<td>".($x&&$y?'T':'F')."</td>";
  echo "<td>".($x||$y?'T':'F')."</td>";
  echo "<td>".($x^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$x?'T':'F')."</td>";
  echo "<td>".(!($x&&$y)?'T':'F')."</td>";
  echo "<td>".(!$x|| !$y?'T':'F')."</td>";
  echo "<td>".(!($x||$y)?'T':'F')."</td>";
  echo "<td>".(!$x && !$y?'T':'F')."</td>";

  ?>
  </tr>
  <tr>
  <?php
    //Second Row of truth table
  //Set x and y
  $y=false;
  //Output the cells for this row
    echo "<td>".($x?'T':'F')."</td>";
    echo "<td>".($y?'T':'F')."</td>";
  echo "<td>".(!$x?'T':'F')."</td>";
    echo "<td>".(!$y?'T':'F')."</td>";
  echo "<td>".($x&&$y?'T':'F')."</td>";
  echo "<td>".($x||$y?'T':'F')."</td>";
  echo "<td>".($x^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$x?'T':'F')."</td>";
  echo "<td>".(!($x&&$y)?'T':'F')."</td>";
  echo "<td>".(!$x|| !$y?'T':'F')."</td>";
  echo "<td>".(!($x||$y)?'T':'F')."</td>";
  echo "<td>".(!$x && !$y?'T':'F')."</td>";

  ?>
  </tr>
<tr>
  <?php
    //Second Row of truth table
  //Set x and y
  $x=false;$y=true;
  //Output the cells for this row
    echo "<td>".($x?'T':'F')."</td>";
    echo "<td>".($y?'T':'F')."</td>";
  echo "<td>".(!$x?'T':'F')."</td>";
    echo "<td>".(!$y?'T':'F')."</td>";
  echo "<td>".($x&&$y?'T':'F')."</td>";
  echo "<td>".($x||$y?'T':'F')."</td>";
  echo "<td>".($x^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$x?'T':'F')."</td>";
  echo "<td>".(!($x&&$y)?'T':'F')."</td>";
  echo "<td>".(!$x|| !$y?'T':'F')."</td>";
  echo "<td>".(!($x||$y)?'T':'F')."</td>";
  echo "<td>".(!$x && !$y?'T':'F')."</td>";

  ?>
  </tr>
<tr>
  <?php
    //Second Row of truth table
  //Set x and y
  $x=false;$y=false;
  //Output the cells for this row
    echo "<td>".($x?'T':'F')."</td>";
    echo "<td>".($y?'T':'F')."</td>";
  echo "<td>".(!$x?'T':'F')."</td>";
    echo "<td>".(!$y?'T':'F')."</td>";
  echo "<td>".($x&&$y?'T':'F')."</td>";
  echo "<td>".($x||$y?'T':'F')."</td>";
  echo "<td>".($x^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$y?'T':'F')."</td>";
  echo "<td>".($x^$y^$x?'T':'F')."</td>";
  echo "<td>".(!($x&&$y)?'T':'F')."</td>";
  echo "<td>".(!$x|| !$y?'T':'F')."</td>";
  echo "<td>".(!($x||$y)?'T':'F')."</td>";
  echo "<td>".(!$x && !$y?'T':'F')."</td>";

  ?>
  </tr>
</table>

</body>
</html>