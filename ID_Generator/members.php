<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Members</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script type="text/javascript">
            // function performBackup(){
            //     let xhttp=new XMLHttpRequest();
            //     xhttp.onreadystatechange=function(){
            //         if (this.readyState == 4 && this.status == 200)
            //         {
            //             document.getElementById("BackupAlert").removeAttribute("hidden");
            //         }
            //     };
            //     xhttp.open("POST","backup.php",true);
            //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //     xhttp.send();
            // }
        </script>
    </head>
    <body style="padding-top: 50px;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">CoEnSoBEC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Sign Up</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="members.php">Members <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container my-4">
            <div class="row">
                <div class="col-sm-6">
                    <form action="backup.php" method="POST">
                        <input class="btn btn-primary" type="submit" name="BackupButton" value="Back-Up">
                    </form>
                    <!-- <button type="button" class="btn btn-success" onclick="performBackup()" name="BackupButton">Back-Up</button> -->
                    <div class="alert alert-success my-2" id="BackupAlert" role="alert" hidden>
                        Backup Successful!
                    </div>
                </div>
                <div class="col-sm-6">
                    <form class="form-inline" action="restore.php" method="POST" enctype="multipart/form-data">
                        <input class="form-control col-sm-8" type="file" name="RestoreFile" required>
                        <input class="btn btn-danger col-sm-2 ml-auto" type="submit" name="RestoreButton" value="Restore">
                    </form>
                    <div class="alert alert-success my-2" id="RestoreAlert" role="alert" hidden>
                        Restore Successful!
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-4">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Joined</th>
                        <th scope="col">Image</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());
                        //$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

                        mysqli_select_db($con, "btech2017");
                        //mysqli_select_db($con, "StudentDataBase");

                        $rowno=1;
                        $query = mysqli_query($con, "SELECT * FROM AS_ARG_TABLE");
                        while($row=mysqli_fetch_array($query))
                        {?>
                            <tr>
                                <th scope="row"><?php echo $rowno;?></th>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["course"]; ?></td>
                                <td><?php echo $row["yoj"]; ?></td>
                                <td>
                                    <img height="70" width="70" src="<?php echo $row["profile"]; ?>" alt="Unavailable">
                                </td>
                                <td>
                                    <form action="confirm.php" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="type" value="PDF" hidden>
                                        <input type="text" name="info" value="<?php echo $row["profile"]; ?>" hidden>
                                        <input type="submit" class="btn btn-sm btn-success" name="generatepdf" value="Generate PDF">
                                    </form>
                                    <form action="confirm.php" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="type" value="IMG" hidden>
                                        <input type="text" name="info" value="<?php echo $row["profile"]; ?>" hidden>
                                        <input type="submit" class="btn btn-sm btn-info my-1" name="generate" value="Generate PNG">
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $rowno=$rowno+1;
                        }
                        mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
