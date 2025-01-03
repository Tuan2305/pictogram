<?php

require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die ("database is not connected");
// function for showing page    
function showPage($page, $data=""){
    
    include( "assets/pages/$page.php");
}

//function for follow the user
function followUser($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO follow_list(follower_id,user_id) VALUES($current_user, $user_id)";
    return mysqli_query($db, $query);
}

//function for like post
function like($post_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO likes(post_id,user_id) VALUES($post_id, $current_user)";
    return mysqli_query($db, $query);
}

// funxtion for unlike post
function unlike($post_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM likes WHERE  user_id = $current_user && post_id = $post_id";
    return mysqli_query($db, $query);
}
 
// function for check like status
function checkLikeStatus($post_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM likes WHERE user_id = $current_user && post_id = $post_id";
    $run = mysqli_query($db,$query);
    if ($run) { // Kiểm tra xem truy vấn có thành công hay không
        $result = mysqli_fetch_assoc($run); // Lấy dữ liệu hàng đầu tiên dưới dạng mảng kết hợp
        return $result['row']; // Trả về giá trị của cột 'row'
    }
    return false; // Trả về false nếu truy vấn không thành công
}



//function for unfollow the user
function unfollowUser($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM follow_list WHERE follower_id = $current_user && user_id = $user_id";
    return mysqli_query($db, $query);
}
// function for show errors
function showError($field){
    if (isset($_SESSION['error'])){
        $error = $_SESSION['error'];

        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="alert alert-danger my-2" role="alert">
               <?=$error['msg'] ?>
            </div>
            <?php
        }
    }
}


// function show for prevformfata
function showFormData($field) {
    if (isset($_SESSION['formdata'])){
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
        
    }
    
}
// for checking duplicate email
function isEmailRegistered($email){
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE email = '$email'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];

}

// for checking duplicate username
function isUsernameRegistered($username){
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE username = '$username'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];

}

// for checking duplicate username
function isUsernameRegisteredByOther($username){
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM users WHERE username = '$username' && id!= $user_id";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];

}
// for validating the signup form
function validateSigupForm($form_data){
$response = array();    
$response['status'] = true;

    if (!$form_data['username']){
        $response['msg'] = 'username is not given';
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if (!$form_data['password']){
        $response['msg'] = 'password is not given';
        $response['status'] = false;
        $response['field'] = 'password';
    }

    if(!$form_data['first_name']){
        $response['msg'] = 'first name is not given';
        $response['status'] = false;
        $response['field'] = 'first_name';
    }
    if (!$form_data['last_name']){
        $response['msg'] = 'last name is not given';
        $response['status'] = false;
        $response['field'] = 'last_name';
    }
    if (!$form_data['email']){
        $response['msg'] = 'email is not given';
        $response['status'] = false;
        $response['field'] = 'email';
    }
    if (isEmailRegistered($form_data['email'])){
        $response['msg'] = 'email id is already registered';
        $response['status'] = false;
        $response['field'] = 'email';
    }
    if (isUsernameRegistered($form_data['username'])){
        $response['msg'] = 'username id is already registered';
        $response['status'] = false;
        $response['field'] = 'username';
    }   
    return $response;
     

};

// for validating the login form
function validateLoginForm($form_data){
    $response = array();    
    $response['status'] = true;
    $blank = false;
        if (!$form_data['password']){
            $response['msg'] = 'password is not given';
            $response['status'] = false;
            $response['field'] = 'password';
            $blank = true;
        }
        if (!$form_data['username_email']){
            $response['msg'] = 'username/email is not given';
            $response['status'] = false;
            $response['field'] = 'username_email';
            $blank = true;
        }
        
        if (!$blank && !checkUser($form_data)['status']){
            $response['msg'] = "something is incorrect, we can't find you ";
            $response['status'] = false;
            $response['field'] = 'checkuser';
        }
        else{
            $response['user'] = checkUser($form_data)['user'];
        }

        return $response;
         
    
    };

    // for checking the user
    function checkUser($login_data){
        global $db;
        $username_email = $login_data['username_email'];
        $password = md5($login_data['password']);
    
        $query = "SELECT * FROM users WHERE (email = '$username_email' || username = '$username_email') &&  password = '$password'";
        $run = mysqli_query($db,$query);
        $data['user'] = mysqli_fetch_assoc($run)??array();
        if (count($data['user']) > 0 ){
            $data['status'] = true;
        }
        else{
            $data['status'] = false;
        }
        return $data;
    }

// for getting userdata by id
function getUser($user_id){
    global $db;


    $query = "SELECT * FROM users WHERE id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
    
}
// for getting post by id
function getPostById($user_id){
    global $db;
    $query = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY id DESC" ;
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
    
}
// for filtering the suggestion list
function filterFollowSuggestions(){
    $list = getFollowSuggestions();
    $filter_list = array();
    foreach($list as $user){
        if (!checkFollowStatus($user['id']) && count($filter_list)<6){
            $filter_list[] = $user;
        }
    }
    return $filter_list;

}

// for checking user is followed by current user or not
function checkFollowStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM follow_list WHERE follower_id = $current_user && user_id = $user_id";
    $run = mysqli_query($db,$query);
    if ($run) { // Kiểm tra xem truy vấn có thành công hay không
        $result = mysqli_fetch_assoc($run); // Lấy dữ liệu hàng đầu tiên dưới dạng mảng kết hợp
        return $result['row']; // Trả về giá trị của cột 'row'
    }
    return false; // Trả về false nếu truy vấn không thành công
}

// for getting users follow suggestions
function getFollowSuggestions(){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM users WHERE id!= $current_user LIMIT 7";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get follower count
function getFollowers($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id= $user_id ";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function getFollowing($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id= $user_id ";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}
// for getting userdata by username
function getUserByUsername($username){
    global $db;
    $query = "SELECT * FROM users WHERE username='$username'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
    
}


// for getting post
function getPost(){
    global $db;
    $query = "SELECT posts.id,posts.user_id, posts.post_img, posts.post_text, posts.created_at,users.first_name, users.last_name,users.username, 
    users.profile_pic FROM posts JOIN users ON users.id= posts.user_id ORDER BY id DESC" ;
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
    
}

// for getting post dynamically
function filterPosts(){
    $list = getPost();
    $filter_list = array();
    foreach($list as $post){
        if (checkFollowStatus($post['user_id']) || $post['user_id'] == $_SESSION['userdata']['id']){
            $filter_list[] = $post;
        }
    }
    return $filter_list;

}

        
// for create new user
function createUser($data){
    global $db;
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $gender = $data['gender'];
    $email = mysqli_real_escape_string($db, $data['email']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);
    $password = md5($password);


    $query = "INSERT INTO users(first_name, last_name, gender, email, username, password)";
    $query.= "VALUES ('$first_name','$last_name', $gender, '$email','$username','$password')";
    return mysqli_query($db, $query);
}

// function for verify email
function verifyEmail($email){
    global $db;

    $query = "UPDATE users SET ac_status = 1 WHERE email = '$email'";
    return mysqli_query($db,$query);
}
// function for verify email
function resetPassword($email, $password){
    global $db;
    $password = md5($password);
    $query = "UPDATE users SET password = '$password' WHERE email = '$email'";
    return mysqli_query($db,$query);
}

// for validating update form

// for validating the signup form
function validateUpdateForm($form_data,$image_data){
    $response = array();    
    $response['status'] = true;
    
        if (!$form_data['username']){
            $response['msg'] = 'username is not given';
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if (!$form_data['password']){
            $response['msg'] = 'password is not given';
            $response['status'] = false;
            $response['field'] = 'password';
        }
    
        if(!$form_data['first_name']){
            $response['msg'] = 'first name is not given';
            $response['status'] = false;
            $response['field'] = 'first_name';
        }
        if (!$form_data['last_name']){
            $response['msg'] = 'last name is not given';
            $response['status'] = false;
            $response['field'] = 'last_name';
        }
     
      
        if (isUsernameRegisteredByOther($form_data['username']) && $form_data['username'] != $_SESSION['userdata']['username']) {
            $response['msg'] =$form_data['username']. "is already registered";
            $response['status'] = false;
            $response['field'] = 'username';
        }   

        if($image_data['name']){
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            $size = $image_data['size']/1000 ;
            if($type != 'jpg' && $type!='jpeg' && $type != 'png'){
                $response['msg'] = 'only jpg, png,jpeg image are allowed';
                $response['status'] = false;
                $response['field'] = 'profile_pic';
            }

            if ($size > 1000){
                $response['msg'] = 'upload image less then 1 mb';
                $response['status'] = false;
                $response['field'] = 'profile_pic';
            }
        }
        return $response;
         
    
    };

    // function updatrProfile()
function updateProfile($data,$imagedata){
        global $db;
        $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);
   
    if(!$data['password']){
        $password = $_SESSION['userdata']['password'];

    }
    else{
        $password = md5($password);
        $_SESSION['userdata']['password'] = $password;

    }
    $profile_pic = "";
    if($imagedata['name']){
        if (!is_dir('../images/profile/')) {
            mkdir('../images/profile/', 0777, true);
        }
        $image_name =time().basename($imagedata['name']);
        $image_dir ="../images/profile/$image_name";
        if (!move_uploaded_file($imagedata['tmp_name'], $image_dir)) {
            echo "Failed to upload the profile picture.";
        echo "Tmp name: " . $imagedata['tmp_name'];
        echo "Target directory: " . $image_dir;
            die("Failed to upload the profile picture.");
        }
        $profile_pic=",profile_pic= '$image_name'";
        $_SESSION['userdata']['profile_pic'] = $image_name;
      
    }
        $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name',username = '$username', password = '$password' $profile_pic WHERE id=".$_SESSION['userdata']['id'];
        if (!mysqli_query($db, $query)) {
            die("Query failed: " . mysqli_error($db));
        }
    
        $_SESSION['userdata']['first_name'] = $first_name;
        $_SESSION['userdata']['last_name'] = $last_name;
        $_SESSION['userdata']['username'] = $username;
    
        return true;
    
    }
    


// for validating add post form
function validatePostImage($image_data){
    $response = array();    
    $response['status'] = true;
    
        if (!$image_data['name']){
            $response['msg'] = 'no image is selected';
            $response['status'] = false;
            $response['field'] = 'post_img';
        }
        

        if($image_data['name']){
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            $size = $image_data['size']/1000 ;
            
            if($type != 'jpg' && $type!='jpeg' && $type != 'png'){
                $response['msg'] = 'only jpg, png,jpeg image are allowed';
                $response['status'] = false;
                $response['field'] = 'post_img';
            }

            if ($size > 1000){
                $response['msg'] = 'upload image less then 1 mb';
                $response['status'] = false;
                $response['field'] = 'post_img';
            }
        }
        return $response;
         
    
    };   
    // for create post image

function creatPost($text, $image){
    global $db;
    $post_text = mysqli_real_escape_string($db, $text['post_text']);
    $user_id = $_SESSION['userdata']['id'];

        $image_name =time().basename($image['name']);   
        $image_dir ="../images/posts/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);
    

    $query = "INSERT INTO posts(user_id, post_text,post_img)";
    $query.= "VALUES ($user_id,'$post_text', '$image_name')";
    return mysqli_query($db, $query);
} 

    
?>


