<?php

require_once 'functions.php';


if(isset($_GET['test'])){
    $active_chat_ids = getActiveChatUserIds();
    print_r($active_chat_ids);
}   


if(isset($_GET['unblock'])){
    $user_id = $_POST['user_id'];
    if(unblockUser($user_id)){
        $response['status'] = true;
    }
    else{
        $response['status'] = false;
    }
    echo json_encode($response);
}



if(isset($_GET['follow'])){
    $user_id = $_POST['user_id'];
    
    if(followUser($user_id)){
        $response['status'] = true;
    }
    else{
        $response['status'] = false;
    }
    echo json_encode($response);
}
if(isset($_GET['unfollow'])){
    $user_id = $_POST['user_id'];
    if(unfollowUser($user_id)){
        $response['status'] = true;
    }
    else{
        $response['status'] = false;
    }
    echo json_encode($response);
}

if(isset($_GET['like'])){
    $post_id = $_POST['post_id'];
     if(!checkLikeStatus($post_id)){
        if(like($post_id)){
            $response['status'] = true;
        }
        else{
            $response['status'] = false;
        }
        echo json_encode($response);
    }
   
}

if(isset($_GET['unlike'])){
    $post_id = $_POST['post_id'];
    if(checkLikeStatus($post_id)){
        if(unlike($post_id)){
            $response['status'] = true;
        }
        else{
            $response['status'] = false;
        }
        echo json_encode($response);
    }
   
}
// comment
if(isset($_GET['addcomment'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    
        if(addComment($post_id, $comment)){
            $cuser = getUser($_SESSION['userdata']['id']);
            $response['status'] = true;
            $response['comment'] = '<div class="d-flex align-items-center p-2 border-bottom">
                                    <div>
                                        <img src="assets/images/profile/' .$cuser['profile_pic'].'" alt="" height="50" class="rounded-circle border">
                                    </div>
                                    <div>&nbsp;&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-start align-items-center">
                                        <h6 style="margin: 0px; font-size: small;"><a href="?u=' .$cuser['username'].'" class = "text-decoration-none text-dark">@'.$cuser['username'].'</a></h6>
                                        <p style="margin:0px;" class="text-muted">@.'. $_POST['comment'].'</p>
                                    </div>
                                </div>';
            
        }
        else{
            $response['status'] = false;
        }
        echo json_encode($response);
   
}

if (isset($_GET['getNotifications'])) {
    error_log("Fetching notifications for user: " . $_SESSION['userdata']['id']);
    $user_id = $_SESSION['userdata']['id'];
    $notifications = getNotifications($user_id);
    foreach ($notifications as $not) {
        $time = $not['created_at'];
        $fuser = getUser($not['from_user_id']);
        $post = '';
        if ($not['post_id']) {
            $post = 'data-bs-toggle="modal" data-bs-target="#postview' . $not['post_id'] . '"';
        }
        echo "
        <div class='d-flex justify-content-between border-bottom'>
            <div class='d-flex align-items-center p-2'>
                <div><img src='assets/images/profile/{$fuser['profile_pic']}' alt='' height='30' class='rounded-circle border'></div>
                <div class='ms-2'>
                    <p class='mb-0'>{$fuser['username']} {$not['message']}</p>
                    <small class='text-muted'>{$time}</small>
                </div>
            </div>
            <div class='p-2'>
                <button class='btn btn-sm btn-primary' {$post}>View</button>
            </div>
        </div>";
    }
}