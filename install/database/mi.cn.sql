# Host: localhost  (Version: 5.7.26)
# Date: 2020-02-23 20:03:45
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ad"
#

DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `pid` int(10) DEFAULT NULL COMMENT '广告位置ID',
  `ad_name` varchar(50) DEFAULT NULL COMMENT '广告名称',
  `ad_link` varchar(255) DEFAULT NULL COMMENT '广告链接',
  `ad_code` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `enabled` tinyint(1) DEFAULT '1' COMMENT '是否显示, 0 不显示/1　显示',
  `orderby` smallint(6) DEFAULT '100' COMMENT '排序',
  `bgcolor` varchar(20) NOT NULL COMMENT '背景颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "ad"
#

/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;

#
# Structure for table "address"
#

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品评论 ID',
  `users_id` int(10) DEFAULT NULL COMMENT '用户 id',
  `user_name` varchar(50) DEFAULT NULL COMMENT '收货人',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '手机',
  `province` int(10) DEFAULT NULL COMMENT '省份',
  `city` int(10) DEFAULT NULL COMMENT '城市',
  `county` int(10) DEFAULT NULL COMMENT '地区',
  `user_adress` varchar(50) DEFAULT NULL COMMENT '详细地址',
  `user_zipcode` int(10) DEFAULT NULL COMMENT '邮编',
  `default` tinyint(1) DEFAULT '1' COMMENT '是否默认地址 0 否/1 是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "address"
#

/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;

#
# Structure for table "brand"
#

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL COMMENT '所属分类ID',
  `name` varchar(100) NOT NULL COMMENT '品牌名称',
  `logo` varchar(255) NOT NULL COMMENT '品牌logo',
  `url` varchar(255) NOT NULL COMMENT '品牌首页',
  `sort` smallint(16) NOT NULL COMMENT '排序',
  `isshow` tinyint(1) NOT NULL COMMENT '0 不显示,1 显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "brand"
#

/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

#
# Structure for table "cart"
#

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '购物车表',
  `user_id` mediumint(8) DEFAULT '0' COMMENT '用户 id',
  `session_id` char(128) DEFAULT NULL COMMENT 'session',
  `goods_id` mediumint(8) DEFAULT '0' COMMENT '商品 id',
  `goods_sn` varchar(60) DEFAULT NULL COMMENT '商品货号',
  `goods_name` varchar(120) DEFAULT NULL COMMENT '商品名称',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '市场价',
  `goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '本店售价',
  `goods_num` smallint(5) DEFAULT NULL COMMENT '购买商品数量',
  `spec_key` varchar(64) DEFAULT NULL COMMENT '商品规格 key',
  `spec_name` varchar(64) DEFAULT NULL COMMENT '商品规格名称',
  `selected` tinyint(1) DEFAULT '1' COMMENT '购物车选中状态',
  `add_time` int(11) DEFAULT NULL COMMENT '加入购物车时间',
  `sku` varchar(128) DEFAULT NULL COMMENT 'sku',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "cart"
#

/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

#
# Structure for table "category"
#

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '分类名称',
  `catepic` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `isshow` tinyint(1) NOT NULL COMMENT '0 不显示,1 显示',
  `pid` int(10) DEFAULT NULL,
  `sort` smallint(16) NOT NULL DEFAULT '100' COMMENT '排序',
  `time` int(10) NOT NULL COMMENT '创建时间',
  `color` tinyint(1) NOT NULL COMMENT '是否带颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "category"
#

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

#
# Structure for table "config"
#

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `k` varchar(50) NOT NULL COMMENT 'k键',
  `keyname` varchar(50) NOT NULL COMMENT 'k键值',
  `v` text NOT NULL COMMENT '值',
  `type` varchar(30) NOT NULL COMMENT '类型',
  `desribes` varchar(30) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "config"
#

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'网站域名（如：http://www.google.com）, 后面不带斜线','SiteaUrl','https://www.chiqinga.com','system','网站地址'),(2,'网站标题','SiteaName','王赤清个人网站','system','网站名称'),(3,'网站Logo,最佳尺寸200*90','SiteaLogo','','system','网站Logo'),(4,'网站关键词，便于SEO','MetaKeywords','王赤清,博客，个人网站','system','网站关键词'),(5,'网站搜索引擎描述','MetaDescription','王赤清个人网站是记录生活片段的网站','system','网站描述'),(6,'设置在网站底部显示的备案号，如：\"苏ICP备15189103号 - 1\"','RecordNo','苏ICP备 0000000号 - 1','system','网站备案号'),(7,'设置在网站底部显示的版权信息','MetaCopyright','Copyright &copy; 2015 - ','system','版权信息');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

#
# Structure for table "g_comment"
#

DROP TABLE IF EXISTS `g_comment`;
CREATE TABLE `g_comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品评论 ID',
  `goods_id` int(10) DEFAULT NULL COMMENT '商品 ID',
  `users_id` int(10) DEFAULT NULL COMMENT '评论用户 ID',
  `p_id` int(10) DEFAULT '0' COMMENT '父 ID',
  `o_id` int(10) DEFAULT NULL COMMENT '订单 ID',
  `content` text COMMENT '评论内容',
  `add_time` int(10) DEFAULT NULL COMMENT '评论时间',
  `add_ip` varchar(16) DEFAULT NULL COMMENT '评论IP',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  `c_img` varchar(255) DEFAULT NULL COMMENT '用户晒图地址',
  `goods_rank` int(10) DEFAULT NULL COMMENT '商品评价等级',
  `zan_unm` int(10) DEFAULT '0' COMMENT '本条评论被点赞数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "g_comment"
#

/*!40000 ALTER TABLE `g_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `g_comment` ENABLE KEYS */;

#
# Structure for table "goods"
#

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品 id',
  `uid` int(10) NOT NULL COMMENT '商品分类id',
  `cid` smallint(5) NOT NULL DEFAULT '0' COMMENT '品牌id',
  `name` varchar(120) NOT NULL COMMENT '商品名称',
  `serial` varchar(60) NOT NULL COMMENT '商品货号',
  `sku` varchar(120) DEFAULT NULL COMMENT 'sku',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '售价',
  `count` smallint(5) DEFAULT '10' COMMENT '库存',
  `remark` varchar(255) DEFAULT NULL COMMENT '商品卖点',
  `content` text COMMENT '商品详情',
  `keyword` varchar(255) NOT NULL COMMENT '商品关键字',
  `make` tinyint(1) NOT NULL COMMENT '采购地 0 国内 1 海外/港澳台',
  `city` varchar(255) NOT NULL COMMENT '发货地址',
  `shipping` tinyint(1) NOT NULL COMMENT '0 包邮/1 不包邮',
  `invoice` tinyint(1) NOT NULL COMMENT '发票 0 yes/1 no',
  `repts` tinyint(1) NOT NULL COMMENT '包退服务 0 yes/1 no',
  `recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '推荐 0 yes/1 no',
  `prom` tinyint(1) NOT NULL COMMENT '1 普通订单/2 秒杀商品/3 促销商品',
  `gender` tinyint(1) NOT NULL COMMENT '1 上架/2 仓库',
  `starttime` int(10) NOT NULL COMMENT '商品上架时间',
  `sales_sum` int(11) NOT NULL COMMENT '商品销量',
  `note_num` smallint(5) NOT NULL DEFAULT '0' COMMENT '商品评论数',
  `eye` int(15) DEFAULT '0' COMMENT '商品浏览次数',
  `sort` smallint(16) DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "goods"
#

/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;

#
# Structure for table "goods_attr"
#

DROP TABLE IF EXISTS `goods_attr`;
CREATE TABLE `goods_attr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '属性名称',
  `cid` int(10) NOT NULL COMMENT '分类属性ID',
  `gender` smallint(1) DEFAULT NULL COMMENT '属性类',
  `items` text NOT NULL COMMENT '可选值列表',
  `sort` smallint(16) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "goods_attr"
#

/*!40000 ALTER TABLE `goods_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_attr` ENABLE KEYS */;

#
# Structure for table "goodsattr"
#

DROP TABLE IF EXISTS `goodsattr`;
CREATE TABLE `goodsattr` (
  `goods_attr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `goods_id` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `attr_id` smallint(5) DEFAULT '0' COMMENT '属性ID',
  `attr_value` text COMMENT '属性值',
  `attr_price` varchar(255) DEFAULT NULL COMMENT '属性价格',
  PRIMARY KEY (`goods_attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "goodsattr"
#

/*!40000 ALTER TABLE `goodsattr` DISABLE KEYS */;
/*!40000 ALTER TABLE `goodsattr` ENABLE KEYS */;

#
# Structure for table "goodsimages"
#

DROP TABLE IF EXISTS `goodsimages`;
CREATE TABLE `goodsimages` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品图片ID',
  `goodsid` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `imageurl` varchar(255) DEFAULT NULL COMMENT '图片url地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "goodsimages"
#

/*!40000 ALTER TABLE `goodsimages` DISABLE KEYS */;
/*!40000 ALTER TABLE `goodsimages` ENABLE KEYS */;

#
# Structure for table "goodsseec"
#

DROP TABLE IF EXISTS `goodsseec`;
CREATE TABLE `goodsseec` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品规格ID',
  `goods_id` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `key` varchar(255) NOT NULL COMMENT '规格键名',
  `key_name` varchar(255) DEFAULT NULL COMMENT '规格中文键名',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `store_count` int(10) unsigned DEFAULT '10' COMMENT '库存数量',
  `sku` varchar(128) DEFAULT NULL COMMENT 'sku',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "goodsseec"
#

/*!40000 ALTER TABLE `goodsseec` DISABLE KEYS */;
/*!40000 ALTER TABLE `goodsseec` ENABLE KEYS */;

#
# Structure for table "link"
#

DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `url` varchar(255) NOT NULL COMMENT '网站域名',
  `email` varchar(60) NOT NULL COMMENT '站长email',
  `logo` varchar(255) NOT NULL COMMENT '网站logo',
  `sort` smallint(16) NOT NULL COMMENT '排序',
  `isshow` tinyint(1) NOT NULL COMMENT '0显示,1不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "link"
#

/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

#
# Structure for table "news"
#

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '消息 id',
  `uid` int(10) DEFAULT NULL COMMENT '发起用户 ID',
  `content` varchar(200) DEFAULT NULL COMMENT '消息内容',
  `aid` int(10) DEFAULT NULL COMMENT '接收消息对象 id',
  `status` tinyint(1) DEFAULT '0' COMMENT '0.未读/1.已读',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "news"
#

/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

#
# Structure for table "order_goods"
#

DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `order_id` int(10) DEFAULT NULL COMMENT '订单 ID',
  `goods_id` int(10) DEFAULT NULL COMMENT '商品 ID',
  `goods_name` varchar(120) DEFAULT NULL COMMENT '商品名称',
  `goods_sn` varchar(60) DEFAULT NULL COMMENT '商品货号',
  `goods_num` smallint(5) DEFAULT NULL COMMENT '购买数量',
  `goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品价格',
  `spec_key` varchar(60) DEFAULT NULL COMMENT 'key',
  `spec_key_name` varchar(60) DEFAULT NULL COMMENT '商品规格名称',
  `created_time` int(10) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "order_goods"
#

/*!40000 ALTER TABLE `order_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_goods` ENABLE KEYS */;

#
# Structure for table "orders"
#

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '订单 ID',
  `order_sn` varchar(20) DEFAULT NULL COMMENT '订单编号',
  `users_id` int(10) DEFAULT NULL COMMENT '用户 ID',
  `order_status` tinyint(1) DEFAULT '0' COMMENT '订单状态 0.提交订单/1.正在支付/2.等待发货/3.已发货/4.已收货/5.退货中/6.订单完成',
  `pay_status` tinyint(1) DEFAULT '0' COMMENT '支付状态 0.未付款/1.已付款',
  `pay_id` int(10) DEFAULT NULL COMMENT '支付方式 id',
  `pay_name` varchar(25) DEFAULT NULL COMMENT '支付方式名称',
  `address_id` int(10) DEFAULT NULL COMMENT '收货地址 ID',
  `shipping_id` int(11) DEFAULT '0' COMMENT '物流 ID',
  `shipping_name` varchar(25) DEFAULT NULL COMMENT '物流名称',
  `pack_fee` decimal(10,2) DEFAULT '0.00' COMMENT '物流费',
  `goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品价',
  `order_price` decimal(10,2) DEFAULT '0.00' COMMENT '应付金额',
  `order_time` int(10) DEFAULT NULL COMMENT '下单时间',
  `pay_time` int(10) DEFAULT '0' COMMENT '支付时间',
  `confirm_time` int(10) DEFAULT '0' COMMENT '收货时间',
  `users_note` varchar(50) DEFAULT NULL COMMENT '用户备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "orders"
#

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL COMMENT 'qq登录用户识别码',
  `username` varchar(60) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `mobile` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(60) NOT NULL COMMENT '用户邮箱',
  `pic` varchar(255) NOT NULL COMMENT '用户头像',
  `nickname` varchar(50) NOT NULL COMMENT '第三方昵称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态　0　禁止 1　正常',
  `reg_time` int(10) NOT NULL COMMENT '注册时间',
  `login_time` int(10) NOT NULL COMMENT '最后登录时间',
  `login_ip` varchar(16) NOT NULL COMMENT '最后登录IP',
  `token` int(6) NOT NULL COMMENT '加盐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

#
# Structure for table "user_log"
#

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(60) NOT NULL COMMENT '用户名',
  `time` int(10) NOT NULL COMMENT '登录时间',
  `ip` varchar(16) NOT NULL COMMENT '登录IP',
  `location` text NOT NULL COMMENT '位置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user_log"
#

/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `openid` varchar(100) DEFAULT NULL COMMENT 'QQ登录用户识别码',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像',
  `status` tinyint(1) DEFAULT '1' COMMENT '用户状态 1正常/2 禁止',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `last_login_time` int(10) DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(16) DEFAULT NULL COMMENT '最后登录IP',
  `token` int(6) DEFAULT NULL COMMENT '加盐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
