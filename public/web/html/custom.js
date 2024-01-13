// Remove item
$(document).ready(function () {
    $(document).on("click", ".remove-item", function () {
        var product_variant_id = $(this).attr("data-product_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/cart/remove",
            data: {
                id: product_variant_id,
            },
            success: function (resp) {
                location.reload();
            },
            error: function () {
                $.toast({
                    heading: "Error",
                    text: "Item added failed",
                    showHideTransition: "slide",
                    position: "bottom-right",
                    icon: "error",
                });
            },
        });
    });
});
