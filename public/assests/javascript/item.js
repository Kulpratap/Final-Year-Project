$(document).on("click", "[id^='like-btn']", function (event) {
  event.preventDefault();
  console.log("hello");
  var postId = $(this).attr('id').replace('like-btn', '');
  likePost(postId);
});
$(document).on("click","[id^='add-button']",function (event){
    event.preventDefault();
    var postId = $(this).attr('id').replace('add-button', '');
    addToCart(postId);
})
$(document).on("click","[id^='delete-button']",function (event){
    event.preventDefault();
    var postId = $(this).attr('id').replace('delete-button', '');
    deleteFromCart(postId);
})
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
function addToCart(postId) {
    var quantity = document.getElementById('quantity').value; // Get selected quantity

    // AJAX request to update cart
    $.ajax({
        type: "POST",
        url: "/app/models/add_to_cart.php", // Path to your PHP file handling cart update
        data: { postId: postId, quantity: quantity },
        success: function(response) {
            // Parse the JSON response
            var jsonResponse = JSON.parse(response);
            
            // Check if the request was successful
            if (jsonResponse.success) {
                alert("Item added to cart successfully");
            } else {
                // Check if the error is due to a duplicate entry
                if (jsonResponse.error.includes("Duplicate entry")) {
                    alert("This item is already in your cart!");
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

