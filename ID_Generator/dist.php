<?php
    $con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());
    //$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

    mysqli_select_db($con, "btech2017");
    //mysqli_select_db($con, "StudentDataBase");

    if(!empty($_POST["state_id"]))
    {
        $query = mysqli_query($con,"SELECT * FROM argasdistrict WHERE StCode = '" . $_POST["state_id"] . "'");
        ?>
        <?php
        while($row=mysqli_fetch_array($query))
        {
            ?>
            <option value="<?php echo $row["DistrictName"]; ?>"><?php echo $row["DistrictName"]; ?></option>
            <?php
        }
    }

    mysqli_close($con);
?>
