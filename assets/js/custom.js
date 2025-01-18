// for priview the post image
var input = document.querySelector("#select_post_img");

input.addEventListener("change",preview);

function preview(){
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function(){
        var image_src = filereader.result;
        var image = document.querySelector("#post_img");
        image.setAttribute('src', image_src);
        image.setAttribute('style', 'display:');
    }

}

// for follow the user
$(".followbtn").click(function(){
    var user_id_v =$(this).data('userId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'assets/php/ajax.php?follow',
        method: 'post',
        dataType:'json',
        data: {user_id: user_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
            
                $(button).data('userId',0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> Followed');
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});


// for unfollow the user
$(".unfollowbtn").click(function(){
    var user_id_v =$(this).data('userId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?unfollow',
        method: 'post',
        dataType:'json',
        data: {user_id: user_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
            
                $(button).data('userId',0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> Unfollowed');
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});

// for like the post

$(".like_btn").click(function(){                
    var post_id_v =$(this).data('postId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?like',
        method: 'post',
        dataType:'json',
        data: {post_id: post_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
                $(button).attr('disabled', false);
                $(button).hide();
                $(button).siblings('.unlike_btn').show();
                $('#like_count' + post_id_v).text($('#like_count' + post_id_v).text()*1 + 1);
            }
            else{ 
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});


$(".unlike_btn").click(function(){
    var post_id_v =$(this).data('postId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?unlike',
        method: 'post',
        dataType:'json',
        data: {post_id: post_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
                $(button).attr('disabled', false);
                $(button).hide();
                $(button).siblings('.like_btn').show();
                location.reload();
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});

// for adding comment

$(".add-comment").click(function(){
    var button =this;
    var comment_v = $(button).siblings('.comment-input').val(); 
    if(comment_v == ''){
        // alert('Please enter the comment');
        return 0;
    }

    var post_id_v =$(this).data('postId');
    var cs = $(this).data('cs');

    var page = $(this).data('page');
    $(button).attr('disabled', true);
    $(button).siblings('.comment-input').attr('disabled', true);  
    
    $.ajax({ 
        url: 'assets/php/ajax.php?addcomment',
        method: 'post',
        dataType:'json',
        data: {post_id: post_id_v, comment: comment_v},
        success: function(response){

            console.log(response);
            if(response.status){
                $(button).attr('disabled', false);
                $(button).siblings('.comment-input').attr('disabled', false);
                $(button).siblings('.comment-input').val('');                
                $("#" + cs).prepend(response.comment);

                $('nce').hide();
                if (page == 'wall'){
                    location.reload();
                }
            }
            else{
                $(button).attr('disabled', false);
                $(button).siblings('.comment-input').attr('disabled', false);
            }
        }
    }); 
  
});

  // Search functionality
var sr = false;
$("search").focus(function(){
    $("#search_result").show();

});

$("#search").keyup(function() {
    var keyword_v = $(this).val();

    if (keyword_v.length > 0) {
        $.ajax({
            url: 'assets/php/ajax.php?search',
            method: 'post',
            dataType: 'json',
            data: { keyword: keyword_v },
            success: function(response) {
                console.log(response);

                if (response.status) {
                    $("#sra").html(response.users);
                } else {
                    $("#sra").html('<p class="text-center text-muted">No users found</p>');
                }
            }
        });
    } else {
        $("#sra").html('');
    }
});


// Block user
$(".blockbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;

    $(button).attr('disabled', true);

    console.log('clicked');

    $.ajax({
        url: 'assets/php/ajax.php?block',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);

            if (response.status) {
                location.reload();
            } else {
                $(button).attr('disabled', false);
                alert('Something went wrong, please try again later.');
            }
        }
    });
});




$(".unblockbtn").click(function() {
    var user_id_v = $(this).data('userId');
    var button = this;

    $(button).attr('disabled', true);

    console.log('clicked');

    $.ajax({
        url: 'assets/php/ajax.php?unblock',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);

            if (response.status) {
                location.reload();
            } else {
                $(button).attr('disabled', false);
                alert('Something went wrong, please try again later.');
            }
        }
    });
});

var chatting_user_id = 9;   


function synmsg(){
    $.ajax({
        url: 'assets/php/ajax.php?getmessages',
        method: 'post',
        dataType: 'json',
        data:{chatter_id: chatting_user_id },
        success: function(response){
            console.log(response);
            $("#chatlist").html(response.chatlist);
            $("#user_chat").html(response.chat);
        }
    });

}

synmsg();

setInterval(() =>{
    synmsg();
}, 1000);