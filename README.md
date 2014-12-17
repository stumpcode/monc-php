monc-php
========

php 练手框架，借鉴了大量 yii 的设计，甚至部分类还是从那边拷贝过来(validator)，囫囵吞枣，有待改进

## 特点:

* 分层设计，路由，mvc，ActiveRecord，widgets
* 风格基本沿袭 yii，但是比起yii 要简单很多，所以文件数量之类的对于做些小网站，会比较好把控
* 结合了 [bootstrap](getbootstrap.com), [bower](http://bower.io/), [grunt](https://www.npmjs.com/)

 
* 阿里云(aliyun) ace 的cache 和 storage，能够快速开发 ace 应用
* 程序运行比较简单，只需要部署在 nginx 里，并指向 public 文件夹就好，svn commit 到阿里云的 ace 目录即可。


## controller

## view

## model

## admin 

## widgets

## cms

## aliyun

## markdown

## 前端

* 默认使用 bootstrap 模块
* 需要对资源包进行安装，就是 bower 和 grunt 的使用
    * 如果没有 npm，需要新安装 [http://nodejs.org/](node.js) 
        * `npm install bower -g` 
        * npm 是node.js 的包管理工具，而bower 是一个npm 包
        * 提供两个 npm 的国内源，放置在 ~/.npmrc 文件里，否则下载文件很很慢
        
                #registry = http://registry.npm.taobao.org
                registry = http://registry.cnpmjs.org
    * bowet: twitter 提供的资源包管理工具，可以方便的按照版本雨来下载你需要的资源文件
        * 在 webroot/public 目录下运行  `bower install`，将读取 bower.json 文件中已经配置的依赖
        * 在 webroot/public 目录下运行 `npm install`，将安装 package.json 里的默认配置
        * 
       
    * grunt: js 的maven，用于编译less 文件为 css，压缩js，css文件，并打包
    	* 在 webroot/public 目录下运行 `grunt install`，讲读取 Gruntfile.js 文件，并安装需要的模块
    	* grunt less 主动编译 Gruntfile.js less 任务对应的文件
    	* grunt watch，监控 Gruantfile.js 里定义的 `less/**/*.less` 文件，有变化的时候自动编译成 css，方便调试
    
* 线下开发的时候，阿里云的 cache 和 storage 模块要处理下，根据[官网文档](http://ace.aliapp.com/php/quick-start.md)，需要在 php.ini 增加注册 `auto_prepend_file = <ace.php的路径>`

