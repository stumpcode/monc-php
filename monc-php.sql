/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50613
 Source Host           : localhost
 Source Database       : monc-php

 Target Server Type    : MySQL
 Target Server Version : 50613
 File Encoding         : utf-8

 Date: 12/18/2014 02:13:37 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cate`
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cate`
-- ----------------------------
BEGIN;
INSERT INTO `cate` VALUES ('1', '新闻', '新闻列表', '2014-12-07 22:20:37', '2014-12-07 22:20:30', null, null, 'news'), ('2', '等待领养', '', '2014-12-07 19:19:58', '2014-12-07 23:33:30', null, '0', 'adopt'), ('3', '其他', '其他细节', '2014-12-07 23:33:04', '2014-12-07 23:33:10', null, null, 'others'), ('4', '等待寄养', '', '2014-12-07 23:33:51', '2014-12-07 23:33:51', null, null, 'live'), ('5', '等待捐助', '', '2014-12-07 23:34:05', '2014-12-07 23:34:05', null, null, 'donate'), ('6', '医疗救助', '', '2014-12-07 23:36:08', '2014-12-07 23:36:08', null, null, 'medic');
COMMIT;

-- ----------------------------
--  Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `content` text,
  `alias` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `image` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `content`
-- ----------------------------
BEGIN;
INSERT INTO `content` VALUES ('1', '标题', null, '1', null, '', '2014-12-07 23:49:28', '2014-12-07 23:49:28', null, '100', null), ('2', 'sdkfjsdfh', null, '1', null, '', '2014-12-07 23:54:59', '2014-12-07 23:54:59', null, '100', null), ('3', 'sdkfjsdfh', null, '1', null, '', '2014-12-07 23:55:12', '2014-12-07 23:55:12', null, '100', null), ('4', 'sdkfjsdfh', null, '1', null, '', '2014-12-07 23:55:20', '2014-12-07 23:55:20', null, '100', null), ('5', '测试', null, '1', null, '', '2014-12-07 23:55:32', '2014-12-07 23:55:32', null, '100', null), ('6', '测试', null, '1', null, '', '2014-12-07 23:55:33', '2014-12-07 23:55:33', null, '100', null), ('7', '测试', null, '1', null, '', '2014-12-07 23:55:35', '2014-12-07 23:55:35', null, '100', null), ('8', '测试', null, '1', null, '', '2014-12-07 23:55:36', '2014-12-07 23:55:36', null, '100', null), ('9', '测试', null, '1', null, '', '2014-12-07 23:55:37', '2014-12-07 23:55:37', null, '100', null), ('10', '测试', null, '1', null, '', '2014-12-07 23:55:37', '2014-12-07 23:55:37', null, '100', null), ('11', '测试', null, '1', null, '', '2014-12-07 23:55:38', '2014-12-07 23:55:38', null, '100', null), ('12', '测试', null, '1', null, '', '2014-12-07 23:55:39', '2014-12-07 23:55:39', null, '100', null), ('13', '测试', null, '1', null, '', '2014-12-07 23:55:40', '2014-12-07 23:55:40', null, '100', null), ('14', '测试', null, '1', null, '', '2014-12-07 23:55:40', '2014-12-07 23:55:40', null, '100', null), ('15', '测试', null, '1', null, '', '2014-12-07 23:55:41', '2014-12-07 23:55:41', null, '100', null), ('16', '测试', null, '1', null, '', '2014-12-07 23:55:42', '2014-12-07 23:55:42', null, '100', null), ('17', '测试', null, '1', null, '', '2014-12-07 23:55:42', '2014-12-07 23:55:42', null, '100', null), ('18', '测试', null, '1', null, '', '2014-12-07 23:55:43', '2014-12-07 23:55:43', null, '100', null), ('19', '测试', null, '1', null, '', '2014-12-07 23:55:44', '2014-12-07 23:55:44', null, '100', null), ('20', '测试', null, '1', null, '', '2014-12-07 23:55:44', '2014-12-07 23:55:44', null, '100', null), ('21', '测试', null, '1', '是离开的减肥了是的空间防狼术防狼术快递费了SD卡发牢骚', 'alias1', '2014-12-07 23:55:45', '2014-12-15 23:05:19', null, '100', '/storage/down?key=ac0326f0-549f-0b68-624b-a21b7acd7231.png'), ('22', '测试', null, '1', null, '', '2014-12-07 23:55:46', '2014-12-07 23:55:46', '2014-12-08 00:16:13', '100', null), ('23', '测试', null, '1', null, '', '2014-12-07 23:55:46', '2014-12-07 23:55:46', '2014-12-08 00:16:08', '100', null), ('24', '测试', null, '1', null, '', '2014-12-07 23:55:47', '2014-12-07 23:55:47', '2014-12-08 00:15:36', '100', null), ('25', '测试', null, '1', null, '', '2014-12-07 23:55:47', '2014-12-07 23:55:47', '2014-12-08 00:15:02', '100', null), ('26', '测试', null, '1', null, '', '2014-12-07 23:55:51', '2014-12-07 23:55:51', '2014-12-08 00:12:57', '100', null), ('27', '文章标题', null, '1', '&lt;h4&gt;Events&lt;/h4&gt;&lt;h4&gt;&lt;p&gt;Wysihtml5 exposes a&amp;nbsp;&lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;https://github.com/xing/wysihtml5/wiki/Events&quot;&gt;number of events&lt;/a&gt;. You can hook into these events when initialising the editor:&lt;/p&gt;&lt;div&gt;&lt;pre&gt;$(\'#some-textarea\').wysihtml5({\r\n    &quot;events&quot;: {\r\n        &quot;load&quot;: function() { \r\n            console.log(&quot;Loaded!&quot;);\r\n        },\r\n        &quot;blur&quot;: function() { \r\n            console.log(&quot;Blured&quot;);\r\n        }\r\n    }\r\n});&lt;/pre&gt;&lt;/div&gt;&lt;/h4&gt;&lt;h4&gt;&lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg#shallow-copy-by-default-deep-on-request&quot;&gt;&lt;/a&gt;Shallow copy by default, deep on request&lt;/h4&gt;&lt;h4&gt;&lt;p&gt;Options you pass in will be added to the defaults via a shallow copy. (see&amp;nbsp;&lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;http://api.jquery.com/jQuery.extend/&quot;&gt;jQuery.extend&lt;/a&gt;&amp;nbsp;for details). You can use a deep copy instead (which is probably what you want if you\'re adding tags or classes to parserRules) via \'deepExtend\', as in the parserRules example below.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;/h4&gt;&lt;h4&gt;&lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg#parser-rules&quot;&gt;&lt;/a&gt;&lt;/h4&gt;&lt;h4&gt;&lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg#shallow-copy-by-default-deep-on-request&quot;&gt;&lt;/a&gt;&lt;/h4&gt;', '简写', '2014-12-08 00:25:12', '2014-12-15 22:23:34', null, '100', '/storage/down?key=d0989440-6a1b-74c1-8c7d-0fd3caa0a232.png');
COMMIT;

-- ----------------------------
--  Table structure for `request`
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `home` varchar(255) DEFAULT NULL,
  `id_num` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL,
  `pet_type` varchar(255) DEFAULT NULL,
  `pet_sex` varchar(255) DEFAULT NULL,
  `pet_now` varchar(255) DEFAULT NULL,
  `pet_now_cnt` varchar(255) DEFAULT NULL,
  `pet_now_type` varchar(255) DEFAULT NULL,
  `pet_adult` varchar(255) DEFAULT NULL,
  `pet_disability` varchar(255) DEFAULT NULL,
  `pet_steririize` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `living` varchar(255) DEFAULT NULL,
  `home_idea` varchar(255) DEFAULT NULL,
  `when_pregnant` varchar(255) DEFAULT NULL,
  `ok_return_visit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
