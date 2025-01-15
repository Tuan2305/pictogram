<?php global $user;?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border">
        <div class="container col-9 d-flex justify-content-between">
            <div class="d-flex justify-content-between col-8">
                <a class="navbar-brand" href="?">
                    <img src="assets/images/instagram.png" alt="" height="30">
                </a>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="looking for someone.."aria-label="Search">
                </form>
            </div>


            <ul class="navbar-nav mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="?"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><i class="bi bi-plus-square-fill"></i></a>
                </li>
             
<ul class="navbar-nav flex-fill flex-row justify-content-evenly my-2">
                    
                    <li class="nav-item">
                        <?php 
                        if (getUnreadNotificationsCount() > 0) { ?>
                            <a class="nav-link text-dark position-relative" id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="un-count position-absolute start-10 translate-middle badge rounded-pill bg-danger">
                                    <small><?= getUnreadNotificationsCount() ?></small>
                                </span>
                            </a>
                        <?php } 
                        else { ?>
                            <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#notification_sidebar" role = "button" aria-controls="offcanvasExample">
                                <i class="bi bi-bell"></i>
                            </a>
                        <?php 
                        } 
                        ?>


                    </li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#message_sidebar" ><i class="bi bi-chat-right-dots-fill"></i></a>
                </li>

                <li class="nav-item dropdown dropstart">
                    <a class="nav-link " href="#" id="navbarDropdown" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="" height="30" width="30" class="rounded-circle border profile-pic">
                    </a>    
                    <ul class="dropdown-menu position-absolute top-100 end-50" aria-labelledby="navbarDropdown">
                    <li> <a class="dropdown-item" href="?u=<?=$user['username']?>"> <i class = "bi bi-person"></i>  My Profile</a></li>    
                    <li><a class="dropdown-item" href="?editprofile"> <i class = "bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="assets/php/actions.php?logout">Logout</a></li>
                    </ul>
                </li>


            </ul>


        </div>
    </nav>

