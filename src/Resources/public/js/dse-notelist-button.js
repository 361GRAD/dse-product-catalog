jQuery(function(){
    if (typeof(Storage) !== "undefined") {
        jQuery("a[id^=addToWishlist-]").on("click", function(e) {
            e.preventDefault();
            console.log(jQuery(this).attr("id"));
            //jQuery.fn.updateWishlist();

            return false;
        });
    }
});