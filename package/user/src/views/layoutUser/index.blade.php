<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield("title")</title>
    <base href="{{asset('')}}"/>
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{  asset('css/app.css') }}">
    <link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/style.css">
    <link rel="stylesheet" href="assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/dest/js/index.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{  asset('js/app.js') }}"></script>
</head>
<body>
    @include("user::layoutUser.header")
    @yield("content")
    @include("user::layoutUser.footer")
    <script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/dest/vendors/animo/Animo.js"></script>
    <script src="assets/dest/vendors/dug/dug.js"></script>
    <script src="assets/dest/js/scripts.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/dest/js/waypoints.min.js"></script>
    <script src="assets/dest/js/wow.min.js"></script>
    <!--customjs-->

    <script src="assets/dest/js/custom2.js"></script>

    <script>
        $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
             });
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $(".header-bottom").addClass('fixNav')
                } else {
                    $(".header-bottom").removeClass('fixNav')
                }
            });
        $("#bbb").click(function() {
        var price = Number($("span#total_price").text());
        var id = Number($(this).attr("data-id"));
        var txt = $("textarea#text").val()
        if (price == 0) {
            alert("Đặt hàng không thành công");
            $("a#kkk").attr("href", "{{route('home')}}");
        } else {
            $.ajax({
                url: "/confirmorder",
                type: "POST",
                data: {
                    "id": id,
                    "txt": txt
                },
                success: function(Reponse) {
                    alert("Đặt hàng thành công");
                    window.location.href="/home";
                }
            });
        }
    });
});
    </script>
</body>
</html>
