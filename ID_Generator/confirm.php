<?php
    session_start();
    if($_POST["type"]=="PDF")
        header( 'Location: http://cs.iiests.ac.in/~arijits/ID_Generator/genpdf.php' );
    else if($_POST["type"]=="IMG")
        header( 'Location: http://cs.iiests.ac.in/~arijits/ID_Generator/genimage.php' );

    $con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());
    //$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

    mysqli_select_db($con, "btech2017");
    //mysqli_select_db($con, "StudentDataBase");

    $rowno=1;
    $query = mysqli_query($con, "SELECT * FROM AS_ARG_TABLE WHERE profile=\"".$_POST["info"]."\"");
    if($row=mysqli_fetch_array($query))
    {
        $_SESSION["name"]=$row["name"];
        $_SESSION["dob"]=$row["dob"];
        $_SESSION["yoj"]=$row["yoj"];
        $_SESSION["course"]=$row["course"];
        $_SESSION["bloodgroup"]=$row["bloodgroup"];
        $_SESSION["gender"]=$row["gender"];
        $_SESSION["address"]=$row["address"];
        $_SESSION["profile"]=$row["profile"];
    }
    mysqli_close($con);
?>
