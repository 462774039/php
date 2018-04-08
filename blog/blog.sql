/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-08 22:11:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `last_time` datetime DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `isDelete` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('1', '标题1', '内容1', '2018-04-01 17:09:50', '1', '0', '1');
INSERT INTO `blog` VALUES ('2', '标题2', '内容2', '2018-04-02 21:06:34', '2', '0', '1');
INSERT INTO `blog` VALUES ('3', '文章32', 'ABCD', '2018-04-08 20:11:48', '1', '0', '1');

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `isDelete` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES ('1', '分类1', '0');
INSERT INTO `class` VALUES ('2', '分类2', '0');

-- ----------------------------
-- Table structure for discuss
-- ----------------------------
DROP TABLE IF EXISTS `discuss`;
CREATE TABLE `discuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isDelete` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discuss
-- ----------------------------
INSERT INTO `discuss` VALUES ('1', 'test评论', '2018-04-06 16:11:00', '1', '10', '0');
INSERT INTO `discuss` VALUES ('2', 'test评论2', '2018-04-06 16:33:48', '1', '12', '0');
INSERT INTO `discuss` VALUES ('3', 'test评论3', '2018-04-06 16:42:30', '2', '10', '0');
INSERT INTO `discuss` VALUES ('5', 'xcaaaaa', '2018-04-06 17:11:21', '1', '1', '0');
INSERT INTO `discuss` VALUES ('6', '不知道啊', '2018-04-06 17:11:31', '1', '1', '0');
INSERT INTO `discuss` VALUES ('7', '是是是', '2018-04-06 17:11:45', '1', '1', '0');
INSERT INTO `discuss` VALUES ('8', 's', '2018-04-08 21:24:43', '1', '1', '1');
INSERT INTO `discuss` VALUES ('9', 'ddd', '2018-04-08 21:27:31', '1', '15', '1');
INSERT INTO `discuss` VALUES ('10', '123', '2018-04-08 21:53:52', '1', '15', '0');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isAdmin` int(11) DEFAULT '0',
  `isDelete` int(11) DEFAULT '0',
  `qq` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `make_friends` varchar(255) DEFAULT NULL,
  `self_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '123456', '1', '0', '123456789', '123456789@email.com', '这是交友宣言啊', '这是个人简介啊');
INSERT INTO `users` VALUES ('7', 'e', 'e', '0', '1', null, null, null, null);
INSERT INTO `users` VALUES ('8', 'm1', 'nn', '0', '0', null, null, null, null);
INSERT INTO `users` VALUES ('9', 'nn', 'nn', '0', '0', null, null, null, null);
INSERT INTO `users` VALUES ('10', 'g', 'g', '0', '0', null, null, null, null);
INSERT INTO `users` VALUES ('11', 'ssdd', 'dd', '0', '1', null, null, null, null);
INSERT INTO `users` VALUES ('12', 'momo', 'momo', '0', '0', null, null, null, null);
INSERT INTO `users` VALUES ('13', 'momo1', 'momo', '0', '0', null, null, null, null);
INSERT INTO `users` VALUES ('14', 'eeee', 'e', '0', '1', null, null, null, null);
INSERT INTO `users` VALUES ('15', 'ddd', 'd', '0', '0', '123', '123@qq.com', 'jyxy', 'grjj');
