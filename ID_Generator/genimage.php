<?php

/*$con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());*/
$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

/*mysqli_select_db($con, "btech2017");*/
mysqli_select_db($con, "StudentDataBase");

$rowno=1;
$query = mysqli_query($con, "SELECT name,course FROM AS_ARG_TABLE");
while($row=mysqli_fetch_array($query))
{
    /*echo "<tr><td>ddff</td></tr>";*/
    echo "<th scope=\"row\">".$rowno."</th>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["course"]."</td>";
    echo "</tr>";
    $rowno=$rowno+1;
}
mysqli_close($con);


// try{
//     $imagick = new Imagick();
//     $imagick->readImage('ID_PDF_1.pdf');
//     $imagick->writeImages('temp.jpg', false);
//
// }
// catch(\Exception $e)
// {
//     echo $e->getMessage();
// }
?>
