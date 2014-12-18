<?php
$versionName = '0.0.0';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="zh-CN"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="monc">

    <?= MHtml::css('/css/monc.css') ?>
    <?= MHtml::css("/css/icons.min.css") ?>
    <?= MHtml::css("/bower_components/font-awesome/css/font-awesome.min.css") ?>
    <?= MHtml::css("/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css") ?>


    <?= MHtml::css('/css/admin.css') ?>

    <?= MHtml::javascript('/bower_components/jquery/jquery.js') ?>
    <?= MHtml::javascript('/bower_components/bootstrap/dist/js/bootstrap.js') ?>
    <?=
    MHtml::javascript('/bower_components/jquery.migrate/jquery-migrate-1.2.1.js') ?>
    <?= MHtml::javascript('/bower_components/jquery-ui/jquery-ui.js') ?>
    <?= MHtml::javascript('/js/jquery.yiigridview.js') ?>
    <?=
    Html::javascript('/bower_components/jquery-file-upload-swf/vendor/swfupload/swfupload.js') ?>
    <?=
    Html::javascript('/bower_components/jquery-file-upload-swf/src/jquery.swfupload.js') ?>
    <?= Html::javascript('/bower_components/DatePicker/dateRange.js') ?>

    <?= MHtml::javascript("/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js") ?>
    <?= MHtml::javascript("/bower_components/bootstrap3-wysihtml5-bower/dist/locales/bootstrap-wysihtml5.zh-CN.js") ?>

    <?= MHtml::javascript('/js/mainjs.js') ?>

    <script>
        // 用于绑定页面参数
        var _constructor = function (opts) {
            for (var key in opts) {
                this[key] = opts[key]
            }
        }
        var app = {
            config: {
                res: '<?= param('res') ?>'
            }
        }
    </script>

    <title><?php echo MHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<script type="text/javascript">
    var mainColor = '#428bca';
</script>

<div id="top-bar" class="navbar navbar-default ">
    <?php $this->renderPartial('/admin/_header') ?>
</div>
<div class="page-content">
    <div id="" class="container ban-float-wrapper">
        <?php echo $content; ?>
    </div>
</div>

<div class="footer">
    <div class="container text-center">

        <p class="copyright">
            © 2014 animal.aliyun.com
            <br>
            本站由 <a href="https://monc.cc" target="_blank" class="vendor">monc.cc</a> 开发,
            感谢 <a href="http://1575280371.qzone.qq.com" target="_blank" class="vendor">April
                Chou</a> 设计,
        </p>
    </div>

</div>

<script type="text/javascript">
    <?php if( $arr = $this->getScript()){
        foreach($arr as $one){
            echo $one;
        }
    } ?>
</script>

</body>
</html>
