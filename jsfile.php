<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="./gotop.js"></script>
<script type="text/javascript" src="./fancybox-2.1.7/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="./jslib.js"></script>
<script type="text/javascript" src="./commlib.js"></script>
<script type="text/javascript">
    $(function() {
        $(".card .row.mt-2 .col-md-4 a").mouseover(function() {
            var imgsrc = $(this).children("img").attr("src");
            $("#showGoods").attr({
                "src": imgsrc
            });
        });
    });
    $(".fancybox").fancybox();
</script>