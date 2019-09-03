<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/master.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">IIEST Nexus</a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {% block scheme_active %}{% endblock %}" href="#" id="schemeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Schemes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="schemeDropdown">
                            <a class="dropdown-item" href="{% url 'scheme_app:create' %}">Create</a>
                            <a class="dropdown-item" href="{% url 'scheme_app:list' %}">List</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {% block customer_active %}{% endblock %}" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Customer
                        </a>
                        <div class="dropdown-menu" aria-labelledby="customerDropdown">
                            <a class="dropdown-item" href="{% url 'customer_app:create' %}">Create</a>
                            <a class="dropdown-item" href="{% url 'customer_app:list' %}">List</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {% block transaction_active %}{% endblock %}" href="#" id="transactionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Transaction
                        </a>
                        <div class="dropdown-menu" aria-labelledby="transactionDropdown">
                            <a class="dropdown-item" href="{% url 'transaction_app:create' %}">Create</a>
                            <a class="dropdown-item" href="{% url 'transaction_app:list' %}">List</a>
                        </div>
                    </li>
                </ul>
            </div> -->
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="jumbotron">
                        <h1 class='display-5'>Welcome to IIEST Nexus</h1>
                        <hr>
                        <p class='lead'>Check out the cool features of our Web Site!!</p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="container">
                        <form id="SignInForm" method="POST">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input class="form-control" id="LoginUsername" type="text" name="loginuser" placeholder="Enter Email ID" required>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" id="LoginPassword" type="password" name="loginpass" placeholder="Enter Password" required>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class='btn btn-primary' type="submit" name="login" value="Log In" formaction="login.php">
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="container">
                        <h3>Else Sign Up</h3>
                        <form method="POST">
                            <div class="form-group row">
                                <label class='col-form-label col-sm-3' for="name"><strong>Name</strong></label>
                                <div class="col">
                                    <input class='form-control' type="text" name="name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class='col-form-label col-sm-3' for="email"><strong>Email</strong></label>
                                <div class="col">
                                    <input class='form-control' type="email" name="email" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class='col-form-label col-sm-3' for="password"><strong>Password</strong></label>
                                <div class="col">
                                    <input class='form-control' type="password" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class='col-form-label col-sm-3' for="password"><strong>Date of Birth</strong></label>
                                <div class="col">
                                    <input class='form-control' type="date" name="dob">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input class='btn btn-success' type="submit" name="signup" formaction="signup.php" value="Sign-Up">
                                <input class='btn btn-danger' type="reset" name="reset" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
