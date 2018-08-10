jQuery(function(){
    if (typeof(Storage) !== "undefined") {
        jQuery.fn.showWishlist();

        jQuery(document).on("click", "a.removeProduct", function(e) {
            e.preventDefault();
            jQuery.fn.updateWishlist(jQuery(this).data("pid"));

            return false;
        });

        jQuery("a[id^=clearWishlist-]").on("click", function(e) {
            e.preventDefault();
            jQuery.fn.clearWishlist();

            return false;
        });
    }
});