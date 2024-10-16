<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border">
        <div class="container col-9 d-flex justify-content-between">
            <div class="d-flex justify-content-between col-8">
                <a class="navbar-brand" href="#">
                    <img src="./img/pictogram.png" alt="" height="28">

                </a>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="looking for someone.."
                        aria-label="Search">

                </form>

            </div>


            <ul class="navbar-nav  mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-plus-square-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-bell-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-chat-right-dots-fill"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./img/profile.jpg" alt="" height="30" class="rounded-circle border">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>

            </ul>


        </div>
    </nav>
    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
            <form>
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Edit Profile</h1>
                <div class="form-floating mt-1 col-6">
                    <img src="img/profile.jpg" class="img-thumbnail my-3" style="height:150px;" alt="...">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change Profile Picture</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">
                        <input type="email" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">first name</label>
                    </div>
                    <div class="form-floating mt-1 col-6">
                        <input type="email" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">last name</label>
                    </div>
                </div>
                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                            value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                            value="option2">
                        <label class="form-check-label" for="exampleRadios3">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                            value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Other
                        </label>
                    </div>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">email</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">username</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">password</label>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Update Profile</button>



                </div>

            </form>
        </div>

    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>