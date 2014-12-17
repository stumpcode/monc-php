<div class="panel panel-default ani-body-list">
    <div class="panel-heading">
        <ol class="breadcrumb">
            <li>您所在的位置：</li>
            <li><a href="/">首页</a></li>
            <li><a href="<?= url('/'.$cate->alias) ?>"><?= $cate->title ?></a></li>
            <li><a href="#"><?= $content->title ?></a></li>
        </ol>
    </div>
    <div class="panel-body panel-body-content">
        <div class="heading clearfix">
            <h3><?= $content->title ?></h3>
            <div class="sum">
                <span><?= app()->formatter->format('date', $content->create_time); ?></span>
            </div>
        </div>
        <?php if($content->image){ ?>
            <div class="litpic clearfix">
                <img src="<?= $content->image ?>" alt="<?= $content->title ?>"/>
            </div>
        <?}?>
        <div class="body clearfix">
            <?= html_entity_decode($content->content) ?>
        </div>
        <div class="share clearfix">
            <!-- JiaThis Button BEGIN -->
            <div class="jiathis_style">
                <span class="jiathis_txt">分享到：</span>
                <a class="jiathis_button_tools_1"></a>
                <a class="jiathis_button_tools_2"></a>
                <a class="jiathis_button_tools_3"></a>
                <a class="jiathis_button_tools_4"></a>
                <a href="http://www.jiathis.com/share?uid=1618060" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
                <a class="jiathis_counter_style"></a>
            </div>
            <script type="text/javascript">
                var jiathis_config = {data_track_clickback:'true'};
            </script>
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1618060" charset="utf-8"></script>
            <!-- JiaThis Button END -->
        </div>
    </div>
</div>
