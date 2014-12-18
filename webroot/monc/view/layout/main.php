<html>
<head>
    <title>MONC-PHP</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <?= MHtml::css('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>
    <?= MHtml::css('css/main.css') ?>
    <?= MHtml::javascript('bower_components/jquery/jquery.min.js') ?>
    <?= MHtml::javascript('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>

</head>
<body>

<?= $content ?>

<div class="footer">
    <div id="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 clearfix">
                    <p class="copyright">
                        Copyright
                        ©
                        2014 monc-php.cc
                        <br/>
                        本站由 <a href="http://www.monc.cc" target="_blank" class="vendor">monc.cc</a>
                        开发
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-57803274-2', 'auto');
    ga('send', 'pageview');

</script>


</body>
</html>
