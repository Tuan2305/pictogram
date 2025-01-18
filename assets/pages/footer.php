
<?php if(isset($_SESSION['Auth']))
{
    ?>

<div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" style = "display:none" id = "post_img" class="w-100 rounded border">
                <form method="post" action="assets/php/actions.php?addpost" enctype="multipart/form-data">
                    <div class="my-3">

                        <input class="form-control" name = "post_img" type="file" id="select_post_img">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
                        <textarea name = "post_text" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                    </div>
                <button type="submit" class="btn btn-primary">Post</button>
            
                </form>
            </div>
            
        </div>
  </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="notification_sidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifications</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="notificationContent">
        <?php
        foreach ($notifications as $not) {
            $time = $not['created_at'];
            $fuser = getUser($not['from_user_id']);
            $post = '';
            if ($not['post_id']) {
                $post = 'data-bs-toggle="modal" data-bs-target="#postview' . $not['post_id'] . '"';
            }
            $fbtn = '';
        ?>
<div class="d-flex justify-content-between border-bottom">
                <div class="d-flex align-items-center p-2">
                    <div><img src="assets/images/profile/<?=$ch_user['profile_pic']?>" alt="" height="30" class="rounded-circle border"></div>
                </div>
                <div>&nbsp;&nbsp;</div>
                <div class="d-flex flex-column justify-content-center" <?=$post?>>
                    <a href="#" class="text-decoration-none text-dark"><h6 style="margin: 0px; font-size:small;"><?=$fuser['first_name']?><?=$fuser['last_name']?></h6></a>
                    <p style="margin: 0px; font-size:small" class ="<?=$not['read_status']?'text-muted':''?>">@<?=$fuser['username']?> <?=$not['message']?></p>
                    </a>
                    <time style="font-size:small" class="timeago <?=$not['read_status']?'text-muted':''?> text-small" datetime="<?=$time?>">    </time>
                </div>
                <div class="d-flex align-items-center">
                    <?php
                    if ($not['read_status'] == 0) {
                    ?>
                        <div class="p-1 bg-primary rounded-circle"></div>
                    <?php
                    } else if ($not['read_status'] == 2) {
                    ?>
                        <span class="badge bg-danger">Post Deleted</span>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="message_sidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Messages</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="chatlist" >
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="chatbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex flex-column gap-2" id= "user_chat">
        <div class = "py-2 px-3 border rounded shadow-sm col-8 d-inline-block">
            hiii<br>
            <span style = "font-size:small" class="text-muted" > 12:12</span>
        </div>
        <div class = "py-2 px-3 border rounded shadow-sm col-8 align-self-end d-inline-block bg-primary text-light">
            chopppppp<br>
            <span style = "font-size:small" class="text-light" > 12:12</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<?php
}
?>


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.7.1.js?>"></script>
<!-- <script src="assets/js/jquery.timeago.js?>"></script> -->
<script src="assets/js/custom.js?v=<?=time()?>"></script>
</body>

</html>

<?php

?>