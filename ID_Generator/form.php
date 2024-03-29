<?php
    $con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());
    //$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

    mysqli_select_db($con, "btech2017");
    //mysqli_select_db($con, "StudentDataBase");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>ID Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script type="text/javascript">
            function getdistrict(state_id){
                let xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange=function(){
                    if((this.readyState==4)&&(this.status==200)){
                        document.getElementById("district-list").innerHTML=this.responseText;
                    }
                }
                xhttp.open("POST","dist.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("state_id="+state_id);
            }
        </script>
    </head>
    <body style="padding-top: 50px;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#"><span id="logo">CoEnSoBEC</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="form.php">Sign Up <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.php">Members</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="container my-4">
            <div class="container">
                <form method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label"><strong>Name</strong></label>
                                <div class="col">
                                    <input class="form-control" type="text" name="name" placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="dob" class="col-sm-4 col-form-label"><strong>Date of Birth</strong></label>
                                <div class="col">
                                    <input class="form-control" type="date" name="dob" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="yoj" class="col-sm-4 col-form-label"><strong>Year of Joining</strong></label>
                                <div class="col">
                                    <input class="form-control" type="number" min="1856" step="1" max="2019" name="yoj" placeholder="Enter your Year of Joining" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="course" class="col-sm-4 col-form-label"><strong>Course</strong></label>
                                <div class="col">
                                    <select class="form-control" name="course">
                                        <option value="B.TECH.">B.Tech.</option>
                                        <option value="M.TECH.">M.Tech.</option>
                                        <option value="Dual Degree">Dual Degree</option>
                                        <option value="M.Sc.">M.Sc.</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="bloodgroup" class="col-sm-4 col-form-label"><strong>Blood Group</strong></label>
                                <div class="col">
                                    <select class="form-control" name="bloodgroup">
                                        <option value="B+">B+</option>
                                        <option value="AB+">AB+</option>
                                        <option value="O+">O+</option>
                                        <option value="A+">A+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O-">O-</option>
                                        <option value="A-">A-</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="radio col-sm-4 col-form-label" for="gender"><strong>Gender</strong></label>
                                <div class="container col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                        <label class="form-check-label" for="gender">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Female">
                                        <label class="form-check-label" for="gender">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Other">
                                        <label class="form-check-label" for="gender">Other</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label"><strong>Address</strong></label>
                        <div class="col">
                            <input class="form-control" type="textarea" name="address" placeholder="Enter your current address" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="state" class="col-sm-4 col-form-label"><strong>State</strong></label>
                                <div class="col">
                                    <select onChange="getdistrict(this.value);" name="state" id="state" class="form-control">
                                        <option value="">Select</option>
                                        <?php $query =mysqli_query($con,"SELECT * FROM argasstate");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                            ?>
                                            <option value="<?php echo $row['StCode'];?>"><?php echo $row['StateName'];?></option>
                                            <?php
                                        }
                                        mysqli_close($con);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="district" class="col-sm-4 col-form-label"><strong>District</strong></label>
                                <div class="col">
                                    <select name="district" id="district-list" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="profile" class="col-sm-4 col-form-label"><strong>Profile Picture</strong></label>
                                <div class="col">
                                    <input class="form-control-file" type="file" name="profile" accept="image/*" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label"><strong>Password</strong></label>
                                <div class="col">
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <input class="btn btn-success" type="submit" name="submit" formaction="signup.php" value="Sign Up">
                        <input class="btn btn-danger" type="reset" name="reset" value="Reset">
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>
