<div class="banner">
    <div class="container">
        <div class="show">
            <!--<img src="--><? //= MHtml::resImage('htc8.png') ?><!--" alt="" height="350"/>-->
        </div>
        <div class="info" style="top: 100px;">
            <div class="clearfix" style="margin-left: -20px; ">
                <span style="float: left; margin-right: 10px;">
                    <img src="<?= MHtml::resImage('mc_64.png') ?>" width="50" alt=""
                         style="border-radius: 20px; "/></span>

                <h3 style="float:left">
                    MONC-PHP
                </h3>
            </div>

            <p>php 练手框架，借鉴了大量 yii 的设计，甚至部分类还是从那边拷贝过来(validator)，囫囵吞枣，有待改进</p>

            <p>
                <a class='btn btn-sm-large btn-sub-primary'
                   target='blank'
                   href='https://github.com/monkeycraps/monc-php'
                    >
                    Fork me in GitHub
                </a>
            </p>

            <p><a style="color: white" href="mailto:monkeycraps.lin@gmail.com">monkeycraps.lin(@)gmail.com</a>
            </p>
        </div>
    </div>
</div>

<div class="">
    <div class="container">
        <div class="panels-wrapper">
            <div class="row panels">
                <div class="col-sm-4 panel-item">
                    <a class="panel panel-image" href="javascript:void()">
                        <div class="panel-icon">
                            <i class="fa fa-clock-o icon"></i>
                        </div>
                        <div class="panel-heading">&nbsp;</div>
                        <div class="panel-body">
                            <h3 class="panel-title">分层设计</h3>

                            <p>路由，mvc，ActiveRecord，widgets</p>

                            <p>风格基本沿袭 yii，但是比起yii 要简单很多，所以文件数量之类的对于做些小网站，会比较好把控</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 panel-item">
                    <a class="panel panel-image" href="javascript:void()">
                        <div class="panel-icon">
                            <i class="fa fa-cog icon"></i>
                        </div>
                        <div class="panel-heading">&nbsp;</div>
                        <div class="panel-body">
                            <h3 class="panel-title">结合前端包管理工具</h3>

                            <p>结合了 bootstrap, bower, grunt</p>

                            <p>推荐使用新的规范化的开发方法，简单有效。npm, bower</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 panel-item">
                    <a class="panel panel-image" href="javascript:void()">
                        <div class="panel-icon">
                            <i class="fa fa-rocket icon"></i>
                        </div>
                        <div class="panel-heading">&nbsp;</div>
                        <div class="panel-body">
                            <h3 class="panel-title">支持阿里云(aliyun) ace</h3>

                            <p>程序运行比较简单，只需要部署在 nginx 里，并指向 public 文件夹就好，svn commit 到阿里云的 ace
                                目录即可。</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="feature">
    <div class="container">
        <div class="page-header page-header-with-icon">
            <i class="fa fa-star"></i>

            <h2>案例展示</h2>
        </div>
        <div class="text-boxes">
            <div class="row text-box">
                <div class="col-sm-6">
                    <img class="img-responsive center-block"
                         alt="Lorem ipsum dolor sit amet"
                         style="width: 100%;border-radius: 15px;"
                         src="<?= MHtml::resImage('data.jpg') ?>">
                </div>
                <div class="col-sm-6">
                    <h3 class="title"><a href="javascript:void()">monc.cc</a></h3>

                    <p>
                        markdown 博客网站，利用git 对文章进行管理，随时随地编写文稿，需要提交了，只需要 git -a ./ && git commit -m
                        'my blog today' 即可
                    </p>
                    <a class="btn btn-sub-primary btn-bordered btn-sm"
                       target='blank'
                       href='www.monc.cc'>
                        monc.cc</a>
                </div>
            </div>
            <hr>
            <div class="row text-box">
                <div class="col-sm-6 col-sm-push-6">
                    <img class="img-responsive center-block"
                         alt="Praesent vitae adipiscing nunc"
                         style="width: 100%;border-radius: 15px;"
                         src="<?= MHtml::resImage('showcase-3.jpg') ?>">
                </div>
                <div class="col-sm-6 col-sm-pull-6">
                    <h3 class="title"><a href="javascript:void()">杭州宠物志愿者网站</a>
                    </h3>

                    <p>
                        简单cms 功能，利用标签管理，使用的时候
                    <pre>$art = app()->cms->aliasContent("config", 'about');</pre>
                    获取文章即可
                    <pre>html_entity_decode( $art->content )</pre>
                    </p>
                    <a class="btn btn-sub-primary btn-bordered btn-sm"
                       target='blank'
                       href='animal.aliapp.com'>
                        animal.aliapp.com</a>
                </div>
            </div>
        </div>
    </div>
</div>
