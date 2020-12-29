$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*     $(".single-item").mouseenter(function() {
            $(this).find("div.single-item-caption").show();
        });
        $(".single-item").mouseleave(function() {
            $(this).find("div.single-item-caption").hide();
        }); */
    $("#o").click(function() {
        $("#info").hide();
        $("#order").show();
    });
    $("#i").click(function() {
        $("#info").show();
        $("#order").hide();
    });
    $("#anh1").click(function() {
        $("#anhchinh").attr("src", $("#anh1").attr("src"));
    });
    $("#anh2").click(function() {
        $("#anhchinh").attr("src", $("#anh2").attr("src"));
    });
    $("#anh3").click(function() {
        $("#anhchinh").attr("src", $("#anh3").attr("src"));
    });
    $("#submit").click(function(e) {
        e.preventDefault();
        var user_id = Number($("#user").val());
        if (user_id == 0) alert("Yêu cầu login");
        else {
            var email = $("#email").val();
            var id_product = $("#product").val();
            var url = "/feedback";
            var _token = $("form[name='SetReview']").find("input[name='_token']").val()
            var txt = $("#text").val();
            $.ajax({
                url: '/feedback',
                type: "POST",
                data: {
                    "_token": _token,
                    "user_id": user_id,
                    "feedback": txt,
                    "product_id": id_product
                },
                success: function(data) {
                    $("#text").before("<p><strong>" + data + "</strong></p>");
                    $("#text").before("<p>" + txt + "</p>");
                    $("#text").attr("value", " ");
                }
            });
        }
    });
    $('.sl').bind('keyup mouseup keydown', function () {
        var quantity = $(this).parent().find(".sl").val();
        var cart_id = $("input[name='cart_id']").val();
        var _token = $("input[name='_token']").val();
        var product_id = $(this).parent().find(".product_id").val();
        $.ajax({
            url: '/updatecart',
            type: "POST",
            data: {
                "_token": _token,
                "product_id": product_id,
                "cart_id": cart_id,
                "quantity": quantity
            },
            success: function(Response) {
                $("span#total_price").text(Response);
            }
        });
    });
    /*     $("i.fa-shopping-cart").click(function() {
            var id = $(this).attr("data-id");
            var quantity = Number($("span#qty").text());
            $.ajax({
                url: "/addcart",
                type: "POST",
                data: {
                    "id": id
                },
                success: function(Response) {
                    if (Response == "OK") {
                        alert("đã thêm vào giỏ hàng");
                        $("span#qty").text(quantity + 1)
                    } else {
                        alert("không thể thêm vào giỏ hàng.Yêu cầu đăng nhập");
                    }
                }
            });
        }); */
    $("a#giohang").click(function() {
        var quantity = Number($("span#qty").text());
        if (quantity == 0) {
            alert("giỏ hàng trống qúy khách hãy mua hàng");
            $("a#giohang").attr("href", "javascript:void(0)")
        }
    });
});