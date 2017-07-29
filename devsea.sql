/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : devsea

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-07-30 00:17:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for p_article
-- ----------------------------
DROP TABLE IF EXISTS `p_article`;
CREATE TABLE `p_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `cont` text COMMENT '内容',
  `addtime` varchar(64) DEFAULT NULL,
  `manager` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_article
-- ----------------------------
INSERT INTO `p_article` VALUES ('1', 'tets', '0000000', '2017-07-14 23:24:24', 'admin');
INSERT INTO `p_article` VALUES ('3', 'test123', 'asdfasf', '2017-07-14 23:28:03', null);

-- ----------------------------
-- Table structure for p_bags
-- ----------------------------
DROP TABLE IF EXISTS `p_bags`;
CREATE TABLE `p_bags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL COMMENT '名称',
  `picurl` varchar(255) DEFAULT NULL COMMENT '图片',
  `uid` int(11) DEFAULT NULL,
  `num` int(8) DEFAULT NULL COMMENT '数量',
  `state` int(1) DEFAULT '1' COMMENT '状态 1有效  2无效',
  `addtime` varchar(64) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_bags
-- ----------------------------

-- ----------------------------
-- Table structure for p_config
-- ----------------------------
DROP TABLE IF EXISTS `p_config`;
CREATE TABLE `p_config` (
  `cid` int(11) NOT NULL,
  `type` int(4) DEFAULT '1',
  `cont` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_config
-- ----------------------------
INSERT INTO `p_config` VALUES ('1', '1', '12', 'PK');
INSERT INTO `p_config` VALUES ('2', '1', '10', '团战');
INSERT INTO `p_config` VALUES ('3', '1', '15', null);

-- ----------------------------
-- Table structure for p_incomelog
-- ----------------------------
DROP TABLE IF EXISTS `p_incomelog`;
CREATE TABLE `p_incomelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) unsigned zerofill DEFAULT NULL COMMENT '1充值金币 2充值宝石 3购买商品 4鱼收益 5比赛收益',
  `state` int(11) DEFAULT '1' COMMENT '1收入   2支出 3失败',
  `reson` varchar(255) DEFAULT NULL COMMENT '原因',
  `addymd` varchar(100) DEFAULT NULL,
  `addtime` varchar(100) DEFAULT NULL,
  `orderid` varchar(100) DEFAULT NULL COMMENT 'match id',
  `userid` int(11) DEFAULT NULL,
  `income` varchar(64) DEFAULT '0' COMMENT '金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_incomelog
-- ----------------------------
INSERT INTO `p_incomelog` VALUES ('174', '01', '1', '金币充值', '2017-07-15', '2017-07-15 11:02:23', '0', '1', '2');
INSERT INTO `p_incomelog` VALUES ('175', '01', '1', '金币充值', '2017-07-15', '2017-07-15 11:03:33', '0', '1', '2');
INSERT INTO `p_incomelog` VALUES ('176', '01', '1', '金币充值', '2017-07-15', '2017-07-15 11:05:02', '0', '1', '2');
INSERT INTO `p_incomelog` VALUES ('177', '02', '1', '道具充值', '2017-07-15', '2017-07-15 11:05:14', '0', '1', '2');
INSERT INTO `p_incomelog` VALUES ('178', '03', '2', '购买道具', '2017-07-16 10:34:17', '2017-07-16', '102', '1', '23');
INSERT INTO `p_incomelog` VALUES ('179', '03', '2', '购买鱼', '2017-07-16 11:15:23', '2017-07-16', '106', '1', '12');
INSERT INTO `p_incomelog` VALUES ('180', '03', '2', '购买鱼', '2017-07-16 11:18:10', '2017-07-16', '107', '1', '13');
INSERT INTO `p_incomelog` VALUES ('181', '03', '2', '购买道具', '2017-07-18 21:19:04', '2017-07-18', '108', '3', '24');
INSERT INTO `p_incomelog` VALUES ('182', '03', '2', '购买道具', '2017-07-18 21:19:14', '2017-07-18', '109', '3', '66');
INSERT INTO `p_incomelog` VALUES ('183', '03', '2', '购买道具', '2017-07-18 21:19:25', '2017-07-18', '110', '3', '75');
INSERT INTO `p_incomelog` VALUES ('184', '03', '2', '购买鱼', '2017-07-18 21:55:04', '2017-07-18', '111', '7', '13');
INSERT INTO `p_incomelog` VALUES ('185', '03', '2', '生存场解锁', '2017-07-18', '2017-07-18 21:58:25', '0', '7', '15');
INSERT INTO `p_incomelog` VALUES ('186', '03', '2', '购买鱼', '2017-07-18 22:12:35', '2017-07-18', '112', '8', '18');
INSERT INTO `p_incomelog` VALUES ('187', '03', '2', '生存场解锁', '2017-07-18', '2017-07-18 22:15:18', '0', '8', '15');
INSERT INTO `p_incomelog` VALUES ('188', '04', '1', '自由场鱼收益', '2017-07-19 21:08:10', '2017-07-19', '58', '2', '1.42');
INSERT INTO `p_incomelog` VALUES ('189', '04', '1', '自由场鱼收益', '2017-07-19 21:08:10', '2017-07-19', '57', '3', '1.42');
INSERT INTO `p_incomelog` VALUES ('190', '04', '1', '生存场鱼收益', '2017-07-19 21:15:16', '2017-07-19', '61', '8', '0');
INSERT INTO `p_incomelog` VALUES ('191', '04', '1', '生存场鱼收益', '2017-07-19 21:28:25', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('192', '04', '1', '生存场鱼收益', '2017-07-19 21:30:40', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('193', '04', '1', '生存场鱼收益', '2017-07-19 21:32:00', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('194', '04', '1', '生存场鱼收益', '2017-07-19 21:35:34', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('195', '04', '1', '生存场鱼收益', '2017-07-19 21:36:39', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('196', '04', '1', '生存场鱼收益', '2017-07-19 21:36:49', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('197', '04', '1', '生存场鱼收益', '2017-07-19 21:36:50', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('198', '04', '1', '生存场鱼收益', '2017-07-19 21:37:07', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('199', '04', '1', '生存场鱼收益', '2017-07-19 21:37:55', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('200', '04', '1', '生存场鱼收益', '2017-07-19 21:37:58', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('201', '04', '1', '生存场鱼收益', '2017-07-19 21:38:00', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('202', '04', '1', '生存场鱼收益', '2017-07-19 21:39:56', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('203', '04', '1', '生存场鱼收益', '2017-07-19 21:40:12', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('204', '04', '1', '生存场鱼收益', '2017-07-19 21:40:13', '2017-07-19', '60', '7', '3.50');
INSERT INTO `p_incomelog` VALUES ('205', '03', '2', '购买鱼', '2017-07-19 21:45:50', '2017-07-19', '113', '7', '100');
INSERT INTO `p_incomelog` VALUES ('206', '03', '2', '购买道具', '2017-07-19 23:10:58', '2017-07-19', '114', '7', '24');
INSERT INTO `p_incomelog` VALUES ('207', '03', '2', '购买道具', '2017-07-19 23:11:08', '2017-07-19', '115', '7', '22');
INSERT INTO `p_incomelog` VALUES ('208', '05', '2', 'PK赛收益', '2017-07-22', '2017-07-22 09:15:29', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('209', '05', '1', 'PK赛收益', '2017-07-22', '2017-07-22 09:15:29', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('210', '05', '2', 'PK赛收益', '2017-07-22', '2017-07-22 09:20:32', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('211', '05', '1', 'PK赛收益', '2017-07-22', '2017-07-22 09:20:32', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('212', '05', '2', 'PK赛收益', '2017-07-22', '2017-07-22 09:21:20', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('213', '05', '1', 'PK赛收益', '2017-07-22', '2017-07-22 09:21:20', '71', '5', '12');
INSERT INTO `p_incomelog` VALUES ('214', '05', '2', 'PK赛收益', '2017-07-22', '2017-07-22 09:22:00', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('215', '05', '1', 'PK赛收益', '2017-07-22', '2017-07-22 09:22:00', '71', '7', '12');
INSERT INTO `p_incomelog` VALUES ('216', '05', '2', 'PK赛收益', '2017-07-22', '2017-07-22 09:22:26', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('217', '05', '1', 'PK赛收益', '2017-07-22', '2017-07-22 09:22:26', '71', '7', '12');
INSERT INTO `p_incomelog` VALUES ('218', '03', '2', '购买道具', '2017-07-23 11:22:27', '2017-07-23', '116', '1', '24');
INSERT INTO `p_incomelog` VALUES ('219', '05', '2', 'PK赛收益', '2017-07-23', '2017-07-23 11:50:32', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('220', '05', '1', 'PK赛收益', '2017-07-23', '2017-07-23 11:50:32', '71', '7', '12');
INSERT INTO `p_incomelog` VALUES ('221', '05', '2', 'PK赛收益', '2017-07-23', '2017-07-23 11:53:46', '70', '5', '12');
INSERT INTO `p_incomelog` VALUES ('222', '05', '1', 'PK赛收益', '2017-07-23', '2017-07-23 11:53:46', '71', '7', '12');
INSERT INTO `p_incomelog` VALUES ('223', '03', '2', '购买鱼', '2017-07-23 13:43:11', '2017-07-23', '117', '9', '200');
INSERT INTO `p_incomelog` VALUES ('224', '03', '2', '生存场解锁', '2017-07-23', '2017-07-23 13:43:41', '0', '9', '15');
INSERT INTO `p_incomelog` VALUES ('225', '03', '2', '购买鱼', '2017-07-23 13:45:04', '2017-07-23', '118', '9', '600');
INSERT INTO `p_incomelog` VALUES ('226', '03', '2', '生存场解锁', '2017-07-23', '2017-07-23 13:45:24', '0', '9', '15');

-- ----------------------------
-- Table structure for p_match
-- ----------------------------
DROP TABLE IF EXISTS `p_match`;
CREATE TABLE `p_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `fishname` varchar(64) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT '玩家鱼姓名',
  `userface` varchar(255) DEFAULT NULL COMMENT '鱼图片',
  `type` int(2) DEFAULT NULL COMMENT '比赛类型 1自由场 2生存场 3、团战 4、房间PK',
  `state` int(1) DEFAULT '0' COMMENT '0等待  1比赛中 2比赛结束',
  `commit_id` varchar(100) DEFAULT '' COMMENT '比赛ID',
  `result` int(2) DEFAULT '0' COMMENT '0 未知  1 胜利 2 失败 3 平局',
  `belong` int(1) DEFAULT NULL COMMENT '1 甲方  2 乙方',
  `money` varchar(20) DEFAULT NULL COMMENT '比赛得到的钱',
  `addtime` varchar(30) DEFAULT NULL COMMENT '比赛开始时间',
  `endtime` varchar(30) DEFAULT NULL COMMENT '结束时间',
  `isleader` int(1) DEFAULT '0' COMMENT '0 不是leader  1leader',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_match
-- ----------------------------
INSERT INTO `p_match` VALUES ('87', '9', '收费鱼18', '燕飞', '/Public/Home/img/game/money4.png', '2', '1', '1B860EED-E158-31B7-BCCA-905EC6B464B2', '0', null, null, '2017-07-23 13:50:25', null, '0');
INSERT INTO `p_match` VALUES ('78', '9', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '2', null, null, null, '0');
INSERT INTO `p_match` VALUES ('79', '10', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '2', null, null, null, '0');
INSERT INTO `p_match` VALUES ('80', '11', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '2', null, null, null, '0');
INSERT INTO `p_match` VALUES ('81', '12', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '2', null, null, null, '0');
INSERT INTO `p_match` VALUES ('84', '1', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '2', null, null, null, '0');
INSERT INTO `p_match` VALUES ('75', '4', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '1', null, null, null, '0');
INSERT INTO `p_match` VALUES ('76', '7', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '1', null, null, null, '0');
INSERT INTO `p_match` VALUES ('77', '8', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '1', null, null, null, '0');
INSERT INTO `p_match` VALUES ('85', '9', '免费鱼', '燕飞', '/Public/Home/img/game/free1.png', '1', '1', 'EC20E1C7-AAF8-A285-FE82-7A3DF3C4E199', '0', null, null, '2017-07-23 13:27:38', null, '0');
INSERT INTO `p_match` VALUES ('74', '3', '收费鱼2', '李海龙1', '/Public/Home/img/p_26.png', '3', '1', '6F21A31F-766D-AA4C-3A8B-DEF284134068', '0', '1', null, null, null, '0');
INSERT INTO `p_match` VALUES ('70', '5', null, 'nima', '/Public/Home/img/p_26.png', '4', '2', '8946BE95-A50F-D769-F748-6088FE8C4480', '0', '1', null, null, null, '0');
INSERT INTO `p_match` VALUES ('71', '7', '收费鱼2', '校花', '/Public/Uploads/2017-07-14/5968d11a82039.png', '4', '2', '8946BE95-A50F-D769-F748-6088FE8C4480', '0', '2', null, null, null, '0');

-- ----------------------------
-- Table structure for p_menber
-- ----------------------------
DROP TABLE IF EXISTS `p_menber`;
CREATE TABLE `p_menber` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL COMMENT '电话',
  `pwd` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `fid` int(11) DEFAULT NULL,
  `fids` varchar(255) DEFAULT NULL,
  `incomebag` varchar(64) DEFAULT '0' COMMENT '金币钱包',
  `userface` varchar(255) DEFAULT NULL COMMENT '头像',
  `nowfish` varchar(64) DEFAULT '0' COMMENT '当前的鱼',
  `fighting` int(10) DEFAULT '0' COMMENT '战斗力',
  `addtime` varchar(64) DEFAULT NULL,
  `addymd` varchar(64) DEFAULT NULL,
  `friends` varchar(255) DEFAULT NULL,
  `baoshibag` varchar(64) DEFAULT '0' COMMENT '道具钱包',
  `type` int(2) DEFAULT '1' COMMENT '1普通',
  `iscompetion` int(1) DEFAULT '0' COMMENT '当前是否在比赛 0 没有 1自由场 2生存场 3团战 4PK',
  `islive` int(1) DEFAULT '0' COMMENT '生存场费用 0 未交 1 已交',
  `isoutfree` int(1) DEFAULT '0' COMMENT '0没有出来 1出局',
  `showface` varchar(255) DEFAULT NULL COMMENT '用户真实头像',
  `zhifubao` varchar(100) DEFAULT NULL COMMENT '支付宝',
  `weixin` varchar(100) DEFAULT NULL COMMENT '微信',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_menber
-- ----------------------------
INSERT INTO `p_menber` VALUES ('1', '18883287644', '123456', '李海龙1', '0', '4,2,', '456', '/Public/Home/img/p_26.png', '107', '3', '2017-06-11 17:48:00', '2017-06-11', null, '11352.00', '1', '3', '0', '0', '/Public/Home/img/p_26.png', '123', '123');
INSERT INTO `p_menber` VALUES ('2', '18883287634', '123', '阿斯顿', '1', '1,', '2.42', '/Public/Home/img/p_27.png', '0', '0', '2017-06-11 17:48:00', '2017-06-11', null, null, '1', '3', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('3', '18883287654', '123', '思雨', '1', '1,2,', '36.42', '/Public/Home/img/p_26.png', '0', '2', '2017-06-11 17:48:00', '2017-06-11', null, null, '1', '3', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('4', '188832764', '123', 'adsa', '6', '', '0', '/Public/Home/img/p_27.png', '1', '0', '2017-06-11 17:48:00', '2017-06-11', null, null, '1', '3', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('5', '18883287649', '1', 'nima', '4', '1,2,3,', '1800.00', '/Public/Home/img/p_26.png', '1', '0', '2017-07-15 12:46:07', '2017-07-15', null, '0', '1', '0', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('6', '18883287641', '123', '花和尚', '2', '1,2,', '985', '/Public/Home/img/p_26.png', '0', '0', '2017-07-18 21:39:50', '2017-07-18', null, '0', '1', '2', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('7', '18883287648', '123', '校花', '6', '1,2,6,', '172.00', '/Public/Uploads/2017-07-14/5968d11a82039.png', '113', '0', '2017-07-18 21:47:41', '2017-07-18', null, '0', '1', '0', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('8', '18883287651', '123', '9527', '7', '1,2,6,7,', '5.00', '/Public/Uploads/2017-07-14/5968d1b19f6c9.png', '0', '0', '2017-07-18 22:07:49', '2017-07-18', null, '32', '1', '3', '0', '0', '/Public/Home/img/p_26.png', null, null);
INSERT INTO `p_menber` VALUES ('9', '18883286261', '123', '燕飞', '1', '4,2,1,', '970', '/Public/Home/img/game/money4.png', '118', '0', '2017-07-23 13:26:08', '2017-07-23', null, '200', '1', '2', '0', '0', '/Public/Home/img/p_26.png', null, null);

-- ----------------------------
-- Table structure for p_orderlog
-- ----------------------------
DROP TABLE IF EXISTS `p_orderlog`;
CREATE TABLE `p_orderlog` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '用户id',
  `productid` int(11) NOT NULL,
  `productname` varchar(64) DEFAULT NULL,
  `productmoney` varchar(32) DEFAULT NULL COMMENT '售卖价格',
  `type` int(11) DEFAULT NULL COMMENT '1.道具2.鱼',
  `states` int(11) NOT NULL DEFAULT '0' COMMENT '0待支付 1购买成功 2使用中 3已使用',
  `orderid` varchar(128) NOT NULL COMMENT '订单id',
  `addtime` varchar(64) DEFAULT NULL,
  `num` int(5) DEFAULT NULL COMMENT '购买数量  ',
  `prices` varchar(40) DEFAULT NULL COMMENT '购买单价',
  `pic` varchar(200) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_orderlog
-- ----------------------------
INSERT INTO `p_orderlog` VALUES ('101', '1', '104', '道具22', '22', '1', '2', '道具22', '2017-07-16 09:43:53', '2', '22', '/Public/Uploads/2017-07-14/5968d29cf0735.png');
INSERT INTO `p_orderlog` VALUES ('102', '1', '105', '道具23', '23', '1', '2', '道具23', '2017-07-16 09:44:04', '2', '23', '/Public/Uploads/2017-07-14/5968d2ca929d8.png');
INSERT INTO `p_orderlog` VALUES ('103', '1', '106', '道具24', '24', '1', '2', '道具24', '2017-07-16 09:44:11', '3', '24', '/Public/Uploads/2017-07-14/5968d2e94fae0.png');
INSERT INTO `p_orderlog` VALUES ('104', '1', '107', '道具25', '25', '1', '1', '道具25', '2017-07-16 09:44:19', '1', '25', '/Public/Uploads/2017-07-14/5968d2fe25049.png');
INSERT INTO `p_orderlog` VALUES ('106', '1', '96', '收费鱼1', '12', '2', '1', '收费鱼1', '2017-07-16 11:15:23', '1', '12', '/Public/Uploads/2017-07-14/5968d0f6c09b4.png');
INSERT INTO `p_orderlog` VALUES ('107', '1', '97', '收费鱼2', '13', '2', '1', '收费鱼2', '2017-07-16 11:18:10', '1', '13', '/Public/Uploads/2017-07-14/5968d11a82039.png');
INSERT INTO `p_orderlog` VALUES ('108', '3', '106', '道具24', '24', '1', '1', '道具24', '2017-07-18 21:19:04', '1', '24', '/Public/Uploads/2017-07-14/5968d2e94fae0.png');
INSERT INTO `p_orderlog` VALUES ('109', '3', '104', '道具22', '22', '1', '1', '道具22', '2017-07-18 21:19:14', '3', '66', '/Public/Uploads/2017-07-14/5968d29cf0735.png');
INSERT INTO `p_orderlog` VALUES ('110', '3', '107', '道具25', '25', '1', '1', '道具25', '2017-07-18 21:19:25', '3', '75', '/Public/Uploads/2017-07-14/5968d2fe25049.png');
INSERT INTO `p_orderlog` VALUES ('111', '7', '97', '收费鱼2', '13', '2', '1', '收费鱼2', '2017-07-18 21:55:04', '1', '100', '/Public/Uploads/2017-07-14/5968d11a82039.png');
INSERT INTO `p_orderlog` VALUES ('112', '8', '102', '收费鱼18', '18', '2', '1', '收费鱼18', '2017-07-18 22:12:35', '1', '18', '/Public/Uploads/2017-07-14/5968d1b19f6c9.png');
INSERT INTO `p_orderlog` VALUES ('113', '7', '97', '收费鱼2', '100', '2', '1', '收费鱼2', '2017-07-19 21:45:50', '1', '100', '/Public/Uploads/2017-07-14/5968d11a82039.png');
INSERT INTO `p_orderlog` VALUES ('114', '7', '106', '道具24', '24', '1', '1', '道具24', '2017-07-19 23:10:58', '1', '24', '/Public/Uploads/2017-07-14/5968d2e94fae0.png');
INSERT INTO `p_orderlog` VALUES ('115', '7', '104', '道具22', '22', '1', '1', '道具22', '2017-07-19 23:11:08', '1', '22', '/Public/Uploads/2017-07-14/5968d29cf0735.png');
INSERT INTO `p_orderlog` VALUES ('116', '1', '106', '道具24', '24', '1', '1', '道具24', '2017-07-23 11:22:27', '1', '24', '/Public/Uploads/2017-07-14/5968d2e94fae0.png');
INSERT INTO `p_orderlog` VALUES ('117', '9', '99', '收费鱼3', '200', '2', '1', '收费鱼3', '2017-07-23 13:43:11', '1', '200', '/Public/Home/img/game/money7.png');
INSERT INTO `p_orderlog` VALUES ('118', '9', '102', '收费鱼18', '600', '2', '1', '收费鱼18', '2017-07-23 13:45:04', '1', '600', '/Public/Home/img/game/money4.png');

-- ----------------------------
-- Table structure for p_product
-- ----------------------------
DROP TABLE IF EXISTS `p_product`;
CREATE TABLE `p_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '产品名',
  `cont` text COMMENT '产品描述',
  `pic` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `price` varchar(15) DEFAULT NULL COMMENT '售卖价格',
  `type` int(2) DEFAULT NULL COMMENT '1.道具2.鱼',
  `state` int(3) DEFAULT '1' COMMENT '1上架  2下架',
  `addtime` varchar(100) DEFAULT NULL,
  `salenum` int(11) DEFAULT '0' COMMENT '销售数量',
  `userface` varchar(255) DEFAULT NULL COMMENT '用户显示的头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_product
-- ----------------------------
INSERT INTO `p_product` VALUES ('93', '乌龟', null, '/Public/Uploads/2017-07-16/596ab3f12f76e.png', '0', '2', '1', '2017-07-16 08:31:45', '0', '/Public/Home/img/game/free2.png');
INSERT INTO `p_product` VALUES ('94', '免费鱼1', null, '/Public/Uploads/2017-07-14/5968d059e3fe4.png', '0', '2', '1', '2017-07-14 22:08:25', '0', '/Public/Home/img/game/free1.png');
INSERT INTO `p_product` VALUES ('95', '免费鱼2', null, '/Public/Uploads/2017-07-14/5968d08bf26ec.png', '0', '2', '1', '2017-07-14 22:09:15', '0', '/Public/Home/img/game/free3.png');
INSERT INTO `p_product` VALUES ('96', '收费鱼1', '', '/Public/Uploads/2017-07-14/5968d0f6c09b4.png', '50', '2', '1', '2017-07-18 22:19:37', '0', '/Public/Home/img/game/money9.png');
INSERT INTO `p_product` VALUES ('97', '收费鱼2', '', '/Public/Uploads/2017-07-14/5968d11a82039.png', '100', '2', '1', '2017-07-18 22:19:50', '0', '/Public/Home/img/game/money8.png');
INSERT INTO `p_product` VALUES ('99', '收费鱼3', '', '/Public/Uploads/2017-07-14/5968d17d476d0.png', '200', '2', '1', '2017-07-18 22:20:03', '0', '/Public/Home/img/game/money7.png');
INSERT INTO `p_product` VALUES ('100', '收费鱼16', '', '/Public/Uploads/2017-07-14/5968d18f2e532.png', '400', '2', '1', '2017-07-18 22:20:12', '0', '/Public/Home/img/game/money6.png');
INSERT INTO `p_product` VALUES ('101', '收费鱼17', '', '/Public/Uploads/2017-07-14/5968d1a27c8b3.png', '500', '2', '1', '2017-07-18 22:20:25', '0', '/Public/Home/img/game/money5.png');
INSERT INTO `p_product` VALUES ('102', '收费鱼18', '', '/Public/Uploads/2017-07-14/5968d1b19f6c9.png', '600', '2', '1', '2017-07-18 22:20:33', '0', '/Public/Home/img/game/money4.png');
INSERT INTO `p_product` VALUES ('104', '道具22', '增加生命值', '/Public/Uploads/2017-07-14/5968d29cf0735.png', '22', '1', '1', '2017-07-16 08:37:24', '0', null);
INSERT INTO `p_product` VALUES ('105', '道具23', '增加气血值', '/Public/Uploads/2017-07-14/5968d2ca929d8.png', '23', '1', '1', '2017-07-16 08:37:44', '0', null);
INSERT INTO `p_product` VALUES ('106', '道具24', '增加防御值', '/Public/Uploads/2017-07-14/5968d2e94fae0.png', '24', '1', '1', '2017-07-16 08:37:56', '0', null);
INSERT INTO `p_product` VALUES ('107', '道具25', '增加敏捷度', '/Public/Uploads/2017-07-14/5968d2fe25049.png', '25', '1', '1', '2017-07-16 08:38:08', '0', null);

-- ----------------------------
-- Table structure for p_user
-- ----------------------------
DROP TABLE IF EXISTS `p_user`;
CREATE TABLE `p_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '登录名',
  `openid` varchar(255) DEFAULT NULL COMMENT '微信ID',
  `nickname` varchar(255) DEFAULT NULL COMMENT '微信昵称',
  `address` varchar(255) DEFAULT NULL COMMENT '微信地址',
  `userface` varchar(255) DEFAULT NULL COMMENT '维信头像',
  `addtime` varchar(255) DEFAULT NULL COMMENT '注册时间',
  `manager` int(2) DEFAULT '0' COMMENT '0 普通 1管理员 2 超级管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_user
-- ----------------------------
INSERT INTO `p_user` VALUES ('1', '123asd', 'admin', null, null, null, null, '2017-03-10 13:56:27', '2');
INSERT INTO `p_user` VALUES ('2', '123asd', 'admin2', null, null, null, null, '2017-03-10 13:56:27', '1');
