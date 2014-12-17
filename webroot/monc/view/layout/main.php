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
                        本站由 <a href="http://www.monc.cc" target="_blank" class="vendor">monc.cc</a> 开发
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
