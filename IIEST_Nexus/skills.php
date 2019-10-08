<!DOCTYPE html>

<?php
require_once('classes/LoginClass.php');
require_once('classes/User.php');
require_once('classes/variables.php');
require_once('classes/NexusNav.php');

$logged_in_id = LoginClass::isLoggedIn();

if (! $logged_in_id)
{
    header("Location: welcome.php");
    exit();
}

$current_user = new User($logged_in_id);

?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?php echo $current_user->getName(); ?> | Skills</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/master.css">
        <link rel="stylesheet" href="static/css/skills_master.css">
    </head>
    <body>
        <?php echo NexusNav::insertNavbar(); ?>


        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>My Skills</h3>
                    <div class="skill-show">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="search-box">
                                <input class="form-control" type="text" size="30" autocomplete="off" name="skillSearch" placeholder="Search for a skill">
                                <div class="result" id="skillLiveSearch"></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" name="addSkill" id="skillAddBtn">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="static/js/skills_script.js"></script>
    </body>
</html>
