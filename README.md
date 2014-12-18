monc-php
========

php 框架，借鉴了大量 yii 的设计，甚至部分类还是从那边拷贝过来(validator)，囫囵吞枣，有待改进

实例：[monc-php](http://php.monc.cc) ; [杭州宠物志愿者](http://animal.aliapp.com/)

## 特点:

* 分层设计，路由，mvc，ActiveRecord，widgets
* 风格基本沿袭 yii，但是比起yii 要简单很多，所以文件数量之类的对于做些小网站，会比较好把控
* 结合了 [bootstrap](getbootstrap.com), [bower](http://bower.io/), [grunt](https://www.npmjs.com/)

 
* 阿里云(aliyun) ace 的cache 和 storage，能够快速开发 ace 应用
* 程序运行比较简单，只需要部署在 nginx 里，并指向 public 文件夹就好，svn commit 到阿里云的 ace 目录即可。

## env 

* 本模块参考的是 laravel 的做法，在global.func.php 里提供 getEnvAS 方法
* 根据不同的环境获取不同配置文件夹里的配置
	* monc/config/dev
	* monc/config/online 
	* 默认为 online，以防止用户线上错误配置
	* 配置如下 monc/config/env.php，key 为hostname（terminal 下输入命令 hostname 即可获得，value 为对应的环境配置文件夹）
	
			<?php

			return array(
		    	'appletekiMacBook-Pro.local' => 'dev',
			    'appletekiMBP.lan' => 'dev',
			);

	
## controller

* 系统路由功能 app()->controller 可以获取
* 支持的路由规则为固定的 [module]/[controller]/[action]/[param1-name]/[param1-value]/[param2-name]/[param2-value]....
	* 考虑过是否要用 laravel 的规则，但是，实际使用的时候，觉得 laravel 的方式太灵活，但是每个都要设置一下，虽然可以设置通用规则，但是小型网站还不如直接 module/controller/action 的方式，简单直接

## view

* 支持 3 种读取模板方法
	* render：用于返回包含layouts 的界面
	* renderPartial：用于在 view 中导入别的模板文件 
	* wrap：用于layout 里嵌套外层 layouts 
		* layouts 中内容的变量为 $content
* 根据我做这么多网站来看，这 3 种嵌套方式基本满足所有需求
* 所有render 方法支持2个参数，第二个参数为数组，用于模板中输出需要的变量
* render('/....')，即表示，view 的根目录 monc/view/
* render('.../...') 即表示，当前 controller 的相对目录

## model

* 采用 pdo，支持单db，如果需要支持多db，则需要扩展 MDbModel.getDB 方法
* 采用 ActiveRecord 的方式，利用 pdo 读取数据库的表信息，字段信息，用于支持 findByPk, find, findAll 等方法，返回的是 MDbModel 对象，可以根据不同的 table 返回自定可以的 Model，使用很方便。
* 这块读取table 信息的db 查询还没加缓存

## admin 

* 为 /admin，在 AdminController 里，module 支持不到位，主要是 router 规则没处理完善
* 默认登陆为 user: admin, pwd: admin，登陆逻辑在 LoginForm 里，session 保存在 ace cache 里，所以不用担心，因为分布的问题，导致的 session 丢失问题，不过没有验证，ace 这块有没有处理正确，如果 ace 本来就做了，那就庸人自扰了。
* 提供基本的 cms 操作
	* 分类管理（带标签） 
	* 文章管理（带标签）
	* 图片上传（上传 ace ）
	* html 编辑 (bootstrap3-wysihtml5)

## widgets

* 仿照 yii 中的widget 设计，但是没有考虑各种优化性能的办法，常用的有 4 个 
* MActiveForm，表单标准化，支持 MModel(MDbModel, MFormModel，前者用于数据库model，后者用于自定义model)，label 在 monc/messages/trans.php 里定义
	* errorSummary：输出表单错误新
	* activeTextField：输出 input:text 类型
	* activePasswordField：输出 input:password 类型
	* activeSwfUpload：输出图片上传组件
	
			$('#fu-image').rsupload({
	            success: function (data) {
    	            if (data.code != 0) {
	                    alert(data.message);
                   		return;
                	}

                	var file = data.file;
            	    var imgUrl = '/storage/down?key=' + file.fileKey;
        	        $('input.data-image').val(imgUrl);
    	            var $wrapper = $('#image-wrapper');
	                $wrapper.empty();
                	$wrapper.append('<img src="' + imgUrl + '" width="100"/>');
            	}
        	});
        	
	* activeTextAreaField：输出textarea 类型，需要结合 js 才能使用 bootstrap3-wysihtml5 富文本编辑
		`$('#editor').wysihtml5({locale: "zh-CN"});`
		
* MGridView：后台列表管理类
	* 支持动态排序，更新，
	* 支持搜索
	* 支持生成页码
	* 数据源为 MDataProvider
		* MPagination，从 get 获取当前页码
		* fetchData：获取数据列表的方法（在其中调用 pagination 的limit）
		* calculateTotalItemCount：获取数据列表的总行数
	* 支持数据类型格式化，format 方法在 MFommater 中，可以调用 app()->fommater->format($type, $value, $options)
			`array ('image', 'type' => 'image50'), // 格式化输出 50px 宽度的图片`
	* 支持自定义按钮，ajax 请求，ajax 更新会在后续增加
			
			'buttons' => array (
                    'view' => array (
                        'url' => 'url("/admin/content/view", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                    'update' => array (
                        'url' => 'curl("/admin/content/update", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                    'delete' => array (
                        'url' => 'curl("/admin/content/delete", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                ),
                

* MPager，页码
	
		<?php
        $pagination = new MPagination(100);
        $pager = MPager::getInstance(array (
            'pagination' => $pagination
        ));

        echo $pager->render(); ?>
        
* ModelView，MModel 输出所有信息为table，左列为label，右列为数据 
	
		$view = new ModelView(array (
            'model' => $model,
            'columns' => array (
                'title',
                'alias',
                'create_time',
                array ('status', 'type' => 'status'),
                array ('image', 'type' => 'image50'),
                array ('content', 'type' => 'dbhtml'),
            )
        ));
        echo $view->render();
	
	* 支持formater

## cms

* 支持简单的cms 功能，后台可以按需增加 category 和对应 cotent 管理
* 前台读取，有三个获取方法
	* `$list = app()->cms->aliasList('news', null, 6)`：获取分类标签为 news 的所有文章，6篇
	* `$article = app()->cms->aliasContent('manage', 'about')`：获取分类标签为 manage，文章标签为 about 的文章
	* `$cate = app()->cms->aliasCate('manage')`：获取分类标签为 manage 的分类

## aliyun

* cache：MSession 类中使用，比较简单
	`$this->cache = Alibaba::Cache();`
	`$this->cache->get($id);`
	`$this->cache->set($id, $value);`
	`$this->cache->delete($id);`
* storage: StorageController 中使用，原理很简单，但是实际使用纠结了比较久，验证的结果也公布下
	* 阿里云ace 是读 file_exists 和 readfile 做了替换的，所以实际使用过程，不能依赖这两个函数，否则可能会报错，测试过程想在本地做缓存，结果发现 file_exists 文件破坏了我的逻辑
	* 每次刷新页面，访问的节点可能不一样，所以不能靠放文件在本地
	* readfile 会直接从 oss 读取，所以简单的下载逻辑是如此
	
			$storage = Alibaba::Storage();

    	    if (!$storage->fileExists($fileKey)) {
        	    throw new MHttpException(404);
	        }

    	    $meta = $storage->getMeta($fileKey);
	        if (!$meta['content-length']) {
    	        throw new MHttpException('file size is 0 or file not found');
	        }

    	    $tmpFile = MONC . 'tmp' . DS . $fileKey;


        	// 不存在，锁住下载

	        if (!$storage->get($fileKey, $tmpFile)) {
    	        throw new Exception('fail to get file from[' . $fileKey . ']
        	        to [' . $tmpFile . ']');
	        }

    	    header("Content-type: " . $meta['content-type']);
        	header('Content-Disposition: attachment; filename="' . basename($fileKey) . '"');	
	        header("Content-Length: " . $meta['content-length']);

    	    echo readfile($tmpFile);

## markdown

* 这块在 plugin/php_markdown_lib_1_4_0 里，支持到 markdown 的 table 等，原来版本使用的是 github2.css，等我整理下流程再放出
* 我用这块做博客，随时写 .md 文件，觉得不错了，就利用 git commit 上去，根据文件的 inode 时间作为文章的创建时间，很方便

## 前端

* 默认使用 bootstrap 模块
* 需要对资源包进行安装，就是 bower 和 grunt 的使用
    * 如果没有 npm，需要新安装 [http://nodejs.org/](node.js) 
        * `npm install bower -g` 
        * npm 是node.js 的包管理工具，而bower 是一个npm 包
        * 提供两个 npm 的国内源，放置在 ~/.npmrc 文件里，否则下载文件很很慢
        
                #registry = http://registry.npm.taobao.org
                registry = http://registry.cnpmjs.org
    * bower: twitter 提供的资源包管理工具，可以方便的按照版本雨来下载你需要的资源文件
        * 在 webroot/public 目录下运行  `bower install`，将读取 bower.json 文件中已经配置的依赖
        * 在 webroot/public 目录下运行 `npm install`，将安装 package.json 里的默认配置
        
       
    * grunt: js 的maven，用于编译less 文件为 css，压缩js，css文件，并打包
    	* 在 webroot/public 目录下运行 `grunt install`，讲读取 Gruntfile.js 文件，并安装需要的模块
    	* grunt less 主动编译 Gruntfile.js less 任务对应的文件
    	* grunt watch，监控 Gruantfile.js 里定义的 `less/**/*.less` 文件，有变化的时候自动编译成 css，方便调试
    	
    
* 线下开发的时候，阿里云的 cache 和 storage 模块要处理下，根据[官网文档](http://ace.aliapp.com/php/quick-start.md)，需要在 php.ini 增加注册 `auto_prepend_file = <ace.php的路径>`


## ace 中使用 storage 

0. 下载 php 的对应sdk
1. 线下开发的时候，阿里云的 cache 和 storage 模块要处理下，根据[官网文档](http://ace.aliapp.com/php/quick-start.md)，需要在 php.ini 增加注册 `auto_prepend_file = <ace.php的路径>`
2. 吐槽一下，论坛对 markdown 格式输出的界面不甚友好



## bower 使用指南

1. 如果没有 npm，需要新安装 [http://nodejs.org/](node.js) 
2. `npm install bower -g` 
3. npm 是node.js 的包管理工具，而bower 是一个npm 包
4. 提供两个 npm 的国内源，放置在 ~/.npmrc 文件里，否则下载文件很很慢
        
		#registry = http://registry.npm.taobao.org
		registry = http://registry.cnpmjs.org
		
5. bower: twitter 提供的资源包管理工具，可以方便的按照版本雨来下载你需要的资源文件
6. bower init: 生成 bower.json
7. bower install: 在资源目录下运行  `bower install`，将读取 bower.json 文件中已经配置的依赖
8. bower search [包名]：搜索包
9. bower install [包名]，安装指定包
	* --save，讲安装包信息保存到 bower.json 中，以后只要共享这个文件出去给项目组的人就行了
	* 包名 可以是github 上的地址，如 `bower install 'https://github.com/idiot/unslider.git' --save`
10. bowr remove [包名]，移除
 



## grunt 使用指南

1. npm install grunt -g 
2. npm install grunt-cli -g
4. npm init：生成 package.json 文件，npm 的项目初始化
4. npm install：安装package.json 里的插件，grunt-contrib-watch：用于监控，grunt-contrib-less：用于编译less 为css
5. grunt-init gunfile，grunt 的项目初始化
6. 修改 gunfile 如下，基本功能 less, watch


		{
		    "name": "monc-php",
		    "version": "0.1.0",
		    "devDependencies": {
		        "grunt": "~0.4.5",
		        "grunt-contrib-watch": "~0.6.1",
		        "grunt-contrib-less": "~0.12.0"
		    }
		}



		//Gruntfile
		module.exports = function (grunt) {

		    //Initializing the configuration object
		    grunt.initConfig({
        		less: {
		            development: {
        		        options: {
		                    compress: false //minifying the result
        		        },
                		files: {
		                    "./css/main.css": "./less/main.less",
        		            "./css/admin.css": "./less/admin/admin.less"
		                }
        		    }
		        },
        		watch: {
		            less: {
        		        files: [
                		    './less/**/*.less'
		                ],  //watched files
        		        tasks: ['less']                          //tasks to run
		            }
		        }
		    });

		    // Plugin loading
		    grunt.loadNpmTasks('grunt-contrib-watch');
		    grunt.loadNpmTasks('grunt-contrib-less');

		    // Task definition
		    grunt.registerTask('default', ['watch']);
		};

