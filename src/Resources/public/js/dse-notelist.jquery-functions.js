jQuery.fn.extend({
    showWishlist: function () {
        jQuery(".ce_dse_notelist").removeClass("no-data");
        if (localStorage.getItem("dse-wishlist") !== null) {
            var storedObject = JSON.parse(localStorage.getItem("dse-wishlist"));
            jQuery(".item").not('.item-clone').remove();
            if(jQuery(".ce_dse_notelist")[0]) {
                var rowCount = 0;
                storedObject.forEach(function(obj) {
                    jQuery(".ce_dse_notelist .item").first().clone().removeClass("item-clone").appendTo(".ce_dse_notelist .items");
                    if(rowCount < storedObject.length) {
                        var itemObj = "";
                        jQuery.each( obj, function( key, value ) {
                            itemObj = jQuery(".ce_dse_notelist .item").not('.item-clone').eq(rowCount);
                            jQuery(itemObj).children("."+key).text(value);
                        });
                        jQuery(itemObj).find('.actions').children(".removeProduct").attr("data-pid", obj.pId);
                        rowCount++;
                    }
                });
            }
        } else {
            jQuery(".ce_dse_notelist").addClass("no-data");
        }
    },
    updateWishlist: function (deletePId = false) {
        var arrData = [];
        var justUpdate = false;
        var storedObject = JSON.parse(localStorage.getItem("dse-wishlist"));

        // ToDo: Anpassen wenn Referenz Produkte da sind
        var objNewData = {
            pId: Math.floor((Math.random() * 4) + 1),
            pImage: "ImagePath",
            pUrl: window.location.href,
            pAmount: 1
        };

        if (localStorage.getItem("dse-wishlist") !== null) {

            for(var i=0; i<storedObject.length; i++) {
                if(deletePId === false) {
                    if(storedObject[i].pId === objNewData.pId) {
                        justUpdate = true;
                        storedObject[i].pAmount = parseInt(storedObject[i].pAmount) + 1;
                    }
                } else {
                    justUpdate = true;
                    if(storedObject[i].pId === deletePId) {
                        storedObject.splice(i, 1);
                        if(storedObject.length === 0) {
                            jQuery.fn.clearWishlist();
                        }
                    }
                }
            }

            if(storedObject.length > 0) {
                if(justUpdate) {
                    localStorage.setItem("dse-wishlist", JSON.stringify(storedObject));
                }
                if(justUpdate === false && deletePId === false) {
                    arrData = storedObject;
                    arrData.push(objNewData);
                    localStorage.setItem("dse-wishlist", JSON.stringify(arrData));
                }
            }

        } else {
            arrData.push(objNewData);
            localStorage.setItem("dse-wishlist", JSON.stringify(arrData));
        }
        jQuery.fn.showWishlist();
    },
    clearWishlist:function () {
        localStorage.removeItem("dse-wishlist");
        jQuery.fn.showWishlist();

        return false;
    }
});