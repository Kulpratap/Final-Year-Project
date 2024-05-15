$(document).ready(function () {
  // $('.place-order-button').click(function(){
  //   window.location.href="/public/order";
  // })
  // Click event for delete post button
  $('.delete_post_btn').click(function() {
    var postId = $(this).data('postid');
    // Show confirmation dialog
    if (confirm('Are you sure you want to delete this item from your cart?')) {
      // If user confirms, send AJAX request to delete the item
      $.ajax({
          url: '/app/models/delete_from_cart.php', 
          type: 'POST',
          data: { post_id: postId },
          success: function(response) {
              // If deletion is successful, reload the cart page
              window.location.href='cart';
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
          }
      });
    } else {
      // If user cancels, do nothing
      console.log('Deletion canceled');
    }
  });
});
var placeOrderButtons = document.querySelectorAll('.place-order-button');

  // Add click event listener to each button
  placeOrderButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Extract post ID from data attribute
      var postId = this.getAttribute('data-postid');
      // Redirect to order page with post ID
      window.location.href = '/public/order/' + postId;
    });
  });
