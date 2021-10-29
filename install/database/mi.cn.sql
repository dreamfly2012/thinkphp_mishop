-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.28 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 导出  表 xiaomishop.ad 结构
CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `pid` int(10) DEFAULT NULL COMMENT '广告位置ID',
  `ad_name` varchar(50) DEFAULT NULL COMMENT '广告名称',
  `ad_link` varchar(255) DEFAULT NULL COMMENT '广告链接',
  `ad_code` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `enabled` tinyint(1) DEFAULT '1' COMMENT '是否显示, 0 不显示/1　显示',
  `orderby` smallint(6) DEFAULT '100' COMMENT '排序',
  `bgcolor` varchar(20) NOT NULL COMMENT '背景颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.ad 的数据：5 rows
DELETE FROM `ad`;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
INSERT INTO `ad` (`id`, `pid`, `ad_name`, `ad_link`, `ad_code`, `enabled`, `orderby`, `bgcolor`) VALUES
	(1, 11, 'redminote', '', '/uploads/20211028\\33e5dd91b3e5c4f9ee07d8707d7fbf69.jpg', 1, 100, ''),
	(2, 11, '小米笔记本win11', '', '/uploads/20211028\\dbd4604c8af86411840b6a9abdec5ac6.webp', 1, 100, ''),
	(3, 11, '小米平板5', '', '/uploads/20211028\\2845c7859591174d9e83e3cd3196b3a4.webp', 1, 100, ''),
	(4, 1, 'k40', '', '/uploads/20211029\\90a99b03e85a24c54f6883908f3c5bf1.webp', 1, 100, ''),
	(6, 12, 'k40', '', '/uploads/20211029\\914b30be94b45c842db49e19278f218f.webp', 1, 100, '');
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;

-- 导出  表 xiaomishop.address 结构
CREATE TABLE IF NOT EXISTS `address` (
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

-- 正在导出表  xiaomishop.address 的数据：0 rows
DELETE FROM `address`;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;

-- 导出  表 xiaomishop.brand 结构
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL COMMENT '所属分类ID',
  `name` varchar(100) NOT NULL COMMENT '品牌名称',
  `logo` varchar(255) NOT NULL COMMENT '品牌logo',
  `url` varchar(255) NOT NULL COMMENT '品牌首页',
  `sort` smallint(16) NOT NULL COMMENT '排序',
  `isshow` tinyint(1) NOT NULL COMMENT '0 不显示,1 显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.brand 的数据：0 rows
DELETE FROM `brand`;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` (`id`, `cid`, `name`, `logo`, `url`, `sort`, `isshow`) VALUES
	(1, 0, '小米', '', '', 100, 1),
	(2, 0, '红米', '', '', 100, 1);
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- 导出  表 xiaomishop.cart 结构
CREATE TABLE IF NOT EXISTS `cart` (
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

-- 正在导出表  xiaomishop.cart 的数据：0 rows
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- 导出  表 xiaomishop.category 结构
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '分类名称',
  `catepic` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `isshow` tinyint(1) NOT NULL COMMENT '0 不显示,1 显示',
  `ishot` tinyint(1) NOT NULL COMMENT '0未推荐 1推荐',
  `pid` int(10) DEFAULT NULL,
  `sort` smallint(16) NOT NULL DEFAULT '100' COMMENT '排序',
  `time` int(10) NOT NULL COMMENT '创建时间',
  `color` tinyint(1) NOT NULL COMMENT '是否带颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.category 的数据：10 rows
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `catepic`, `isshow`, `ishot`, `pid`, `sort`, `time`, `color`) VALUES
	(1, '手机', '/uploads/20211028\\fc032affc0367b763753b6be40ca7dfc.jpg', 1, 0, 0, 100, 1635404545, 0),
	(2, '电视', '/uploads/20211028\\fdc1c270303b9ba3d88993df1d5d7ed8.jpg', 1, 0, 0, 100, 1635404925, 0),
	(3, '笔记本', '/uploads/20211028\\c9fdf44e472297b6018c734949cf44d9.jpg', 1, 0, 0, 100, 1635404940, 0),
	(4, '家电', '/uploads/20211028\\beb8683be51c624dc22cf0bcbde5d7e8.jpg', 1, 0, 0, 100, 1635406421, 0),
	(5, '出行穿戴', '/uploads/20211028\\53a3266f8ef08f9874662c9309b5008c.jpg', 1, 0, 0, 100, 1635406500, 0),
	(6, '智能设备', '/uploads/20211028\\d47093d8027438eccc1f16cd5cb69f5a.jpg', 1, 0, 0, 100, 1635406524, 0),
	(7, '电源配件', '/uploads/20211028\\f1e1bd86e8bb44c3cc2ff2e43a157b50.jpg', 1, 0, 0, 100, 1635406546, 0),
	(8, '健康儿童', '/uploads/20211028\\7c67c73a17015005e94494abb7fd392a.jpg', 1, 0, 0, 100, 1635406556, 0),
	(9, '耳机音箱', '/uploads/20211028\\4ad91958ebe2e7c27095f8396342b2f4.jpg', 1, 0, 0, 100, 1635406736, 0),
	(10, '生活箱包', '/uploads/20211028\\afc8c10566dec524e4c4738ea370b789.jpg', 1, 0, 0, 100, 1635406764, 0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- 导出  表 xiaomishop.config 结构
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `k` varchar(50) NOT NULL COMMENT 'k键',
  `keyname` varchar(50) NOT NULL COMMENT 'k键值',
  `v` text NOT NULL COMMENT '值',
  `type` varchar(30) NOT NULL COMMENT '类型',
  `desribes` varchar(30) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.config 的数据：7 rows
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `k`, `keyname`, `v`, `type`, `desribes`) VALUES
	(1, '网站域名', 'SiteaUrl', '/', 'system', '网站地址'),
	(2, '网站标题', 'SiteaName', '小米商城', 'system', '网站名称'),
	(3, '网站Logo,最佳尺寸200*90', 'SiteaLogo', '', 'system', '网站Logo'),
	(4, '网站关键词，便于SEO', 'MetaKeywords', '小米商城', 'system', '网站关键词'),
	(5, '网站搜索引擎描述', 'MetaDescription', '小米商城 - Xiaomi 11 Ultra、Redmi K40 Pro、MIX FOLD，小米电视官方网站', 'system', '网站描述'),
	(6, '设置在网站底部显示的备案号', 'RecordNo', '京ICP备10046444号', 'system', '网站备案号'),
	(7, '设置在网站底部显示的版权信息', 'MetaCopyright', 'Copyright &copy; 2015 - ', 'system', '版权信息');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- 导出  表 xiaomishop.goods 结构
CREATE TABLE IF NOT EXISTS `goods` (
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.goods 的数据：8 rows
DELETE FROM `goods`;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id`, `uid`, `cid`, `name`, `serial`, `sku`, `market_price`, `price`, `count`, `remark`, `content`, `keyword`, `make`, `city`, `shipping`, `invoice`, `repts`, `recommend`, `prom`, `gender`, `starttime`, `sales_sum`, `note_num`, `eye`, `sort`) VALUES
	(1, 1, 0, '黑鲨4s', 'heisha4s', '', 2699.00, 2689.00, 999, '', '&lt;p&gt;商品详情&lt;img src=&quot;https://cdn.cnbj1.fds.api.mi-img.com/product-images/blackshark4s5e589d/img_1_3.png&quot;/&gt;&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635478433, 0, 0, 0, 100),
	(2, 1, 0, 'rednote 11', 'RD11', NULL, 1799.00, 1635.00, 999, '', '&lt;p&gt;red11 红米&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480533, 0, 0, 0, 100),
	(3, 1, 0, 'xiaomi mix 4', 'XM 4', NULL, 4999.00, 4599.00, 999, '', '&lt;p&gt;小米mix 4 大屏大享受&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480616, 0, 0, 0, 100),
	(4, 1, 0, 'red note 10', 'RD10', NULL, 1599.00, 1299.00, 6565, '', '&lt;p&gt;rednote10 性价比&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480699, 0, 0, 0, 100),
	(5, 1, 0, 'xiaomi civi', 'XM C', NULL, 2599.00, 2499.00, 5656, '', '&lt;p&gt;xiaomixiaom civis&amp;nbsp;&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480776, 0, 0, 0, 100),
	(6, 1, 0, 'redmi k30', 'RDK30', NULL, 1899.00, 1899.00, 4654, '', '&lt;p&gt;红米k30&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480868, 0, 0, 1, 100),
	(7, 1, 0, 'xiaomi10', 'XM10', NULL, 5999.00, 5999.00, 999, '', '&lt;p&gt;小米10，10年精品&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635480926, 0, 0, 0, 100),
	(8, 1, 0, 'Xiaomi 11 青春版', 'XM11Y', NULL, 2999.00, 2599.00, 999, '', '&lt;p&gt;xiaomi青春版11&lt;/p&gt;', '', 0, '', 0, 1, 0, 0, 1, 1, 1635481025, 0, 0, 0, 100);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;

-- 导出  表 xiaomishop.goodsimages 结构
CREATE TABLE IF NOT EXISTS `goodsimages` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品图片ID',
  `goodsid` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `imageurl` varchar(255) DEFAULT NULL COMMENT '图片url地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.goodsimages 的数据：10 rows
DELETE FROM `goodsimages`;
/*!40000 ALTER TABLE `goodsimages` DISABLE KEYS */;
INSERT INTO `goodsimages` (`id`, `goodsid`, `imageurl`) VALUES
	(1, 1, '/uploads/goods/20211029/7b59e8e6fb4c36f076dfdf843456223e.webp'),
	(2, 1, '/uploads/goods/20211029/169ed34cdeb36ffd9fdb9d9effaea18b.jpg'),
	(3, 1, '&lt;pre&gt;string(45) '),
	(4, 2, '/uploads/goods/20211029/7d02653138438a7229470ca070782940.jpg'),
	(5, 3, '/uploads/goods/20211029/5c5fda0242b7709b58521d4239854b49.jpg'),
	(6, 4, '/uploads/goods/20211029/7288c251d0e700160f0f07c80f8df5a4.jpg'),
	(7, 5, '/uploads/goods/20211029/f9314c5f7f2f016fd90e03bd8428d92c.jpg'),
	(8, 6, '/uploads/goods/20211029/c9608aabe9b4b26ced01790d872f4654.jpg'),
	(9, 7, '/uploads/goods/20211029/f35fdf89fc5236b7d723460dce50239f.jpg'),
	(10, 8, '/uploads/goods/20211029/4098172e4fb9a1be8b9a9d6c268fb8c9.jpg');
/*!40000 ALTER TABLE `goodsimages` ENABLE KEYS */;

-- 导出  表 xiaomishop.goods_attr 结构
CREATE TABLE IF NOT EXISTS `goods_attr` (
  `goods_attr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `goods_id` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `attr_id` smallint(5) DEFAULT '0' COMMENT '属性ID',
  `attr_value` text COMMENT '属性值',
  `attr_price` varchar(255) DEFAULT NULL COMMENT '属性价格',
  PRIMARY KEY (`goods_attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- 正在导出表  xiaomishop.goods_attr 的数据：0 rows
DELETE FROM `goods_attr`;
/*!40000 ALTER TABLE `goods_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_attr` ENABLE KEYS */;

-- 导出  表 xiaomishop.goods_comment 结构
CREATE TABLE IF NOT EXISTS `goods_comment` (
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

-- 正在导出表  xiaomishop.goods_comment 的数据：0 rows
DELETE FROM `goods_comment`;
/*!40000 ALTER TABLE `goods_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_comment` ENABLE KEYS */;

-- 导出  表 xiaomishop.goods_spec 结构
CREATE TABLE IF NOT EXISTS `goods_spec` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品规格ID',
  `goods_id` mediumint(8) DEFAULT '0' COMMENT '商品id',
  `key` varchar(255) NOT NULL COMMENT '规格键名',
  `key_name` varchar(255) DEFAULT NULL COMMENT '规格中文键名',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `store_count` int(10) unsigned DEFAULT '10' COMMENT '库存数量',
  `sku` varchar(128) DEFAULT NULL COMMENT 'sku',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品规格';

-- 正在导出表  xiaomishop.goods_spec 的数据：0 rows
DELETE FROM `goods_spec`;
/*!40000 ALTER TABLE `goods_spec` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_spec` ENABLE KEYS */;

-- 导出  表 xiaomishop.link 结构
CREATE TABLE IF NOT EXISTS `link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `url` varchar(255) NOT NULL COMMENT '网站域名',
  `email` varchar(60) NOT NULL COMMENT '站长email',
  `logo` varchar(255) NOT NULL COMMENT '网站logo',
  `sort` smallint(16) NOT NULL COMMENT '排序',
  `isshow` tinyint(1) NOT NULL COMMENT '0显示,1不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.link 的数据：0 rows
DELETE FROM `link`;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

-- 导出  表 xiaomishop.news 结构
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '消息 id',
  `uid` int(10) DEFAULT NULL COMMENT '发起用户 ID',
  `content` varchar(200) DEFAULT NULL COMMENT '消息内容',
  `aid` int(10) DEFAULT NULL COMMENT '接收消息对象 id',
  `status` tinyint(1) DEFAULT '0' COMMENT '0.未读/1.已读',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.news 的数据：0 rows
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- 导出  表 xiaomishop.orders 结构
CREATE TABLE IF NOT EXISTS `orders` (
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

-- 正在导出表  xiaomishop.orders 的数据：0 rows
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- 导出  表 xiaomishop.order_goods 结构
CREATE TABLE IF NOT EXISTS `order_goods` (
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

-- 正在导出表  xiaomishop.order_goods 的数据：0 rows
DELETE FROM `order_goods`;
/*!40000 ALTER TABLE `order_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_goods` ENABLE KEYS */;

-- 导出  表 xiaomishop.user 结构
CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.user 的数据：1 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `openid`, `username`, `password`, `mobile`, `email`, `pic`, `nickname`, `status`, `reg_time`, `login_time`, `login_ip`, `token`) VALUES
	(1, '', 'admin', 'c93ccd78b2076528346216b3b2f701e6', '', '', '', '', 1, 0, 1635473406, '127.0.0.1', 1234);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- 导出  表 xiaomishop.users 结构
CREATE TABLE IF NOT EXISTS `users` (
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

-- 正在导出表  xiaomishop.users 的数据：0 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- 导出  表 xiaomishop.user_log 结构
CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(60) NOT NULL COMMENT '用户名',
  `time` int(10) NOT NULL COMMENT '登录时间',
  `ip` varchar(16) NOT NULL COMMENT '登录IP',
  `location` text NOT NULL COMMENT '位置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  xiaomishop.user_log 的数据：2 rows
DELETE FROM `user_log`;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
INSERT INTO `user_log` (`id`, `user`, `time`, `ip`, `location`) VALUES
	(1, 'admin', 1635403720, '127.0.0.1', '本地'),
	(2, 'admin', 1635473406, '127.0.0.1', '本地');
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
