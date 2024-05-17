/*
** Manage and update shopping cart quantity displays and 
** handle changes to shopping cart item quantities
*/
jQuery(document).ready(function($) {
    // Initialize the shopping cart count update 
    updateCartCount();

    // Cart count update on events
    $(document.body).on('added_to_cart removed_from_cart updated_wc_div updated_cart_totals', function() {
        updateCartCount();
    });

    //----------------------------------------------
    // Get the current shopping cart item quantity 
    // from the server through AJAX request.
    //----------------------------------------------
    function updateCartCount() {
        console.log("Updating cart count...");
        $.ajax({
            url: updateCartCount_ajaxUrl,
            type: 'POST',
            cache: false,
            data: {
                action: 'get_cart_contents_count'
            },
            success: function(response) {
                console.log("Cart count updated: ", response);
                var count = parseInt(response, 10);
                var $cartCountSpan = $('.main_cart .cart-count');
                if (count > 0) {
                    $cartCountSpan.text(count).show(); 
                } else {
                    $cartCountSpan.hide();
                }
            },
            error: function(xhr, status, error) {
                console.log("Error updating cart count: ", error);
            }
        });
    }

    //----------------------------------------------
    // Cart item quantity change
    //----------------------------------------------
    $(document).on('change', '.cart_item .quantity input', function(e) {
        e.preventDefault();
        var $input = $(this);
        var quantity = $input.val();
        var product_id = $input.closest('.cart_item').find('.remove').data('product_id');

        $.ajax({
            url: updateCartCount_ajaxUrl, 
            type: 'POST',
            data: {
                action: 'update_cart_quantity_action',
                quantity: quantity,
                product_id: product_id
            },
            success: function(response) {
                if (response.success) {
                    $('body').trigger('updated_cart_totals');
                    console.log("Cart updated successfully");
                } else {
                    console.log("Failed to update cart", response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error updating cart: ", error);
            }
        });
    });
});
