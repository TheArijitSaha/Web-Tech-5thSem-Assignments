<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Members</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                        {
                            echo "<tr>\n";
                            echo "\t\t\t\t\t\t<th scope=\"row\">".$rowno."</th>\n";
                            echo "\t\t\t\t\t\t<td>".$row["name"]."</td>\n";
                            echo "\t\t\t\t\t\t<td>".$row["course"]."</td>\n";
                            echo "\t\t\t\t\t\t<td>".$row["yoj"]."</td>\n";
                            echo "\t\t\t\t\t\t<td><img height=\"70\" width=\"70\" src=\"".$row["profile"]."\" alt=\"Unavailable\"></td>\n";
                            echo "\t\t\t\t\t\t<td><form action=\"confirmpdf.php\" method=\"POST\" enctype=\"multipart/form-data\"><input type=\"text\" name=\"info\" value=\"".$row["profile"]."\" hidden><input type=\"submit\" class=\"btn btn-success\" name=\"generate\" value=\"Generate PDF\"></form></td>\n";
                            echo "\t\t\t\t\t</tr>\n";
                            $rowno=$rowno+1;
                        }
                        mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
