$(document).ready(function () {
    loadPosts(0); // Load initial 10 posts on page load
    $(document).on("click", "[id^='add-button']", function(event) {
        event.preventDefault();
        var postId = $(this).attr('id').replace('add-button', '');
        addToCart(postId);  
    });
    
    $('#load-more-btn').on('click', function () {
        var displayedPosts = $('.posts-container .post').length;
        loadPosts(displayedPosts); // Load more posts on button click
    });

    // Event delegation for dynamically loaded posts
    $(document).on('click', '.posts-container .post', function() {
        var postId = $(this).data('postid');
        var url = "/public/item/" + postId;
        window.location.href = url;
    });

    $(document).on("click", "[id^='like-btn']", function (event) {
        event.preventDefault();
        var postId = $(this).attr('id').replace('like-btn', '');
        likePost(postId);
    });
    $(document).on("click", "[id^='post']", function (event) {
        event.preventDefault();
        var postId = $(this).attr('id').replace('like-btn', '');
        likePost(postId);
    });
    $('.posts-container').on("click", "[id^='comment-btn']", function (event) {
        event.preventDefault();
        var postId = $(this).attr('id').replace('comment-btn', '');
        var commentContainer = $(".comment-container" + postId);
        if (!commentContainer.hasClass("loaded")) {
            loadComments(postId);
            commentContainer.addClass("loaded");
        }
        commentContainer.toggle();
    });
 
    $('.posts-container').on("click", ".share-icon", function (event) {
        event.preventDefault();
        var postId = $(this).closest('.reactions').find("[id^='comment-btn']").attr('id').replace('comment-btn', '');
        var commentText = $(this).closest('.reactions').find(".comment-container" + postId + " .comment-text").val();
        if(commentText==''){
            return;
        }
        insertComment(postId, commentText);
    });
});

function loadPosts(offset) {
    $.ajax({
        url: '../app/models/load-seeds-post.php',
        method: 'GET',
        data: { offset: offset },
        success: function (response) {
            var posts = JSON.parse(response);
            if (posts.error) {
                console.error(posts.error);
                return;
            }
            posts.forEach(function (post) {
                var postHTML = `
                <div class="post" data-postid="${post.post_id}">
                <div class="post-image-div">
                    <img class="post-image" src="${post.image_path}" alt="Post Image">
                </div>
                <div class="post-content">
        <!-- Post title and Rs option -->
        <div class="post-details">
            <span class="post-title">${post.Title}</span>
            <span class="rs-option">Rs ${post.amount}</span>
        </div>
        <button class="add-to-cart-btn" id="add-button${post.post_id}">Add to cart</button>
    </div>
            </div>`            
                $('.posts-container').append(postHTML);
            });

            if (posts.length >= 12) {
                $('.button-container').show();
            } else {
                $('.button-container').hide();
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


function likePost(postId) {
    $.ajax({
        url: '../app/models/like.php',
        type: 'POST',
        data: { post_id: postId },
        dataType: 'json',
        success: function (response) {
            if (response && response.likes !== undefined) {
                var likeCount = response.likes;
                var isLiked = response.like_status;
                $('#like-btn' + postId).siblings('.like-count-container').find('.like-count').text(likeCount);
                var likeButton = $('#like-button-i' + postId);

                if (isLiked) {
                    likeButton.removeClass('fa-regular').addClass('fa-solid');
                } else {
                    likeButton.removeClass('fa-solid').addClass('fa-regular');
                }
            } else {
                console.error('Invalid response format:', response);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

function insertComment(postId, commentText) {
    $.ajax({
        url: '../app/models/insert-comment.php',
        method: 'POST',
        data: { postId: postId, commentText: commentText },
        success: function (response) {
            // On successful insertion, call the function to load all comments for the post
            loadComments(postId);
            $(".comment-container" + postId + " .comment-text").val('');
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

function loadComments(postId) {
    $.ajax({
        url: '../app/models/load-comments.php',
        method: 'GET',
        data: { postId: postId },
        success: function (response) {
            var comments = JSON.parse(response);
            var commentContainer = $(".comments-all" + postId);
            commentContainer.empty(); // Clear existing comments
            comments.forEach(function (comment) {
                commentContainer.prepend(`<div class="comment"><p class="commentor">${comment.commenter_name}<p><p>${comment.comment_content}<p></div>`);
            });
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}



function addToCart(postId) {
    var quantity=1;
    console.log(quantity);
    // AJAX request to update cart
    $.ajax({
        type: "POST",
        url: "/app/models/add_to_cart.php", // Path to your PHP file handling cart update
        data: { postId: postId, quantity: quantity},
        success: function(response) {
            // Parse the JSON response
            var jsonResponse = JSON.parse(response);
            
            // Check if the request was successful
            if (jsonResponse.success) {
                alert("Item added to cart successfully");
                window.location.href = 'seeds'; 
            } else {
                // Check if the error is due to a duplicate entry
                if (jsonResponse.error.includes("Duplicate entry")) {
                    alert("This item is already in your cart!");
                    window.location.href = 'seeds'; 
                } else {
                    // Display generic error message
                    console.error(jsonResponse.error);
                }
            }
        },
        error: function(xhr, status, error) {
            // Handle error (if needed)
            console.error(xhr.responseText);
        }
    });
}
