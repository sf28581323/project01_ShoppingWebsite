-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-03-17 01:32:14
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `expstore`
--

-- --------------------------------------------------------

--
-- 資料表結構 `addbook`
--

CREATE TABLE `addbook` (
  `addressid` int(10) NOT NULL COMMENT '地址ID',
  `setdefault` tinyint(1) NOT NULL DEFAULT 0 COMMENT '預設收件人',
  `emailid` int(10) NOT NULL COMMENT '會員編號',
  `cname` varchar(30) NOT NULL COMMENT '收件者姓名',
  `mobile` varchar(20) NOT NULL COMMENT '收件者電話',
  `myzip` varchar(10) DEFAULT NULL COMMENT '郵遞區號',
  `address` varchar(200) NOT NULL COMMENT '收件地址',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `addbook`
--

INSERT INTO `addbook` (`addressid`, `setdefault`, `emailid`, `cname`, `mobile`, `myzip`, `address`, `create_date`) VALUES
(1, 0, 2, '吳大胖', '0989080426', '432', '瑞井路118巷25號', '2025-02-24 07:33:01'),
(2, 1, 11, '吳咸澄', '0989080426', '434', '遠東街', '2025-03-10 06:35:03'),
(3, 0, 11, '吳小胖', '0985837873', '432', '瑞井路118巷25號', '2025-03-10 06:43:41'),
(4, 0, 11, 'Charles Wu', '0938228860', '308', '太陽幼稚園', '2025-03-10 08:04:11'),
(5, 1, 2, '吳咸澄', '0989080426', '434', '遠東街50巷43號2樓', '2025-03-11 01:34:56'),
(6, 1, 3, 'Charles Wu', '0989080426', '434', '太陽幼稚園', '2025-03-14 08:18:35');

-- --------------------------------------------------------

--
-- 資料表結構 `carousel`
--

CREATE TABLE `carousel` (
  `caro_id` int(3) NOT NULL COMMENT '輪播編號',
  `caro_title` varchar(50) DEFAULT NULL COMMENT '輪播標題',
  `caro_content` varchar(100) DEFAULT NULL COMMENT '輪播內容介紹',
  `caro_online` tinyint(1) NOT NULL DEFAULT 1 COMMENT '上下架',
  `caro_sort` int(3) NOT NULL COMMENT '輪播排序',
  `caro_pic` varchar(50) NOT NULL COMMENT '輪播圖檔名稱',
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `carousel`
--

INSERT INTO `carousel` (`caro_id`, `caro_title`, `caro_content`, `caro_online`, `caro_sort`, `caro_pic`, `p_id`, `create_date`) VALUES
(1, NULL, NULL, 1, 1, 'caro_pic01.webp', 5, '2025-01-23 01:16:03'),
(2, NULL, NULL, 1, 2, 'caro_pic02.webp', 10, '2025-01-23 01:16:32'),
(3, NULL, NULL, 1, 3, 'caro_pic03.webp', 13, '2025-01-23 01:16:40'),
(4, NULL, NULL, 1, 4, 'caro_pic04.webp', 20, '2025-01-23 01:16:48');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `cartid` int(10) NOT NULL COMMENT '購物車編號',
  `emailid` int(10) DEFAULT NULL COMMENT '會員編號',
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `qty` int(3) NOT NULL COMMENT '產品數量',
  `orderid` varchar(30) DEFAULT NULL COMMENT '訂單編號',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '訂單處理狀態',
  `ip` varchar(200) NOT NULL COMMENT '訂購者的IP',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '加入購物車時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`cartid`, `emailid`, `p_id`, `qty`, `orderid`, `status`, `ip`, `create_date`) VALUES
(10, NULL, 19, 5, NULL, 1, '127.0.0.1', '2025-02-17 08:02:32'),
(9, NULL, 8, 3, NULL, 1, '127.0.0.1', '2025-02-17 08:02:24'),
(12, 11, 10, 3, '2025031002360960819', 8, '::1', '2025-03-10 06:29:58'),
(13, 11, 8, 1, '2025031002435368233', 8, '::1', '2025-03-10 06:43:09'),
(14, 11, 17, 1, '2025031002435368233', 8, '::1', '2025-03-10 06:43:14'),
(15, 11, 14, 5, '2025031004042052373', 8, '::1', '2025-03-10 08:03:42'),
(16, 2, 1, 1, '2025031109384386221', 8, '::1', '2025-03-11 01:30:20'),
(17, 2, 19, 1, '2025031109390634375', 8, '::1', '2025-03-11 01:38:48'),
(18, 2, 3, 1, '2025031109390634375', 8, '::1', '2025-03-11 01:38:52');

-- --------------------------------------------------------

--
-- 資料表結構 `city`
--

CREATE TABLE `city` (
  `AutoNo` int(10) NOT NULL COMMENT '城市編號',
  `Name` varchar(150) NOT NULL COMMENT '城市名稱',
  `cityOrder` tinyint(2) NOT NULL COMMENT '標記',
  `State` smallint(6) NOT NULL COMMENT '狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `city`
--

INSERT INTO `city` (`AutoNo`, `Name`, `cityOrder`, `State`) VALUES
(1, '臺北市', 0, 0),
(2, '基隆市', 0, 0),
(3, '新北市', 0, 0),
(4, '宜蘭縣', 0, 0),
(5, '新竹市', 0, 0),
(6, '新竹縣', 0, 0),
(7, '桃園市', 0, 0),
(8, '苗栗縣', 0, 0),
(9, '台中市', 0, 0),
(10, '彰化縣', 0, 0),
(11, '南投縣', 0, 0),
(12, '雲林縣', 0, 0),
(13, '嘉義市', 0, 0),
(14, '嘉義縣', 0, 0),
(15, '台南市', 0, 0),
(16, '高雄市', 0, 0),
(17, '南海諸島', 0, 0),
(18, '澎湖縣', 0, 0),
(19, '屏東縣', 0, 0),
(20, '台東縣', 0, 0),
(21, '花蓮縣', 0, 0),
(22, '金門縣', 0, 0),
(23, '連江縣', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `hot`
--

CREATE TABLE `hot` (
  `h_id` int(3) NOT NULL COMMENT '熱銷商品流水號',
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `h_sort` int(3) DEFAULT NULL COMMENT '熱銷商品排名'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `hot`
--

INSERT INTO `hot` (`h_id`, `p_id`, `h_sort`) VALUES
(1, 3, 1),
(2, 8, 2),
(3, 12, 3),
(4, 14, 4),
(5, 16, 5),
(6, 18, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `emailid` int(11) NOT NULL COMMENT 'email流水號',
  `email` varchar(100) NOT NULL COMMENT 'email帳號',
  `pw1` varchar(50) NOT NULL COMMENT '密碼',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否啟動',
  `cname` varchar(30) NOT NULL COMMENT '中文姓名',
  `tssn` varchar(20) NOT NULL COMMENT '身份證字號',
  `birthday` date NOT NULL COMMENT '生日',
  `imgname` varchar(20) DEFAULT NULL COMMENT '相片檔名',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`emailid`, `email`, `pw1`, `active`, `cname`, `tssn`, `birthday`, `imgname`, `create_date`) VALUES
(1, 'sf28581323@gmail.com', '123456', 1, '', '', '0000-00-00', NULL, '2025-02-17 05:47:46'),
(2, 'charles1475321@gmail.com', 'ff30933335d59cb315f32b9d90dc1bcb', 1, '吳大胖', 'L125274293', '1999-04-26', '020.png', '2025-02-24 07:33:01'),
(3, 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Charles Wu', 'L125274293', '2025-03-02', '012.png', '2025-03-14 08:18:35');

-- --------------------------------------------------------

--
-- 資料表結構 `multiselect`
--

CREATE TABLE `multiselect` (
  `msid` int(5) NOT NULL COMMENT '多功能選擇ID',
  `mslevel` int(2) NOT NULL COMMENT '多功能選擇層級',
  `msuplink` int(4) NOT NULL COMMENT '上層連結',
  `opcode` varchar(10) DEFAULT NULL COMMENT '外掛參數',
  `msname` varchar(50) NOT NULL COMMENT '多功能選擇名稱',
  `msort` int(11) DEFAULT NULL COMMENT '各功能列表排序',
  `url1` varchar(200) DEFAULT NULL COMMENT '外掛網址1',
  `url2` varchar(200) DEFAULT NULL COMMENT '外掛網址2',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期',
  `update_date` varchar(50) DEFAULT NULL COMMENT '修改日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `multiselect`
--

INSERT INTO `multiselect` (`msid`, `mslevel`, `msuplink`, `opcode`, `msname`, `msort`, `url1`, `url2`, `create_date`, `update_date`) VALUES
(1, 1, 0, NULL, '付款方式', 0, NULL, NULL, '2023-08-11 09:46:53', '2023-08-17 03:42:28'),
(2, 1, 0, NULL, '訂單處理狀態', 0, NULL, NULL, '2023-08-11 09:52:29', '2023-08-17 03:42:41'),
(3, 2, 1, NULL, '貨到付款', 1, NULL, NULL, '2023-08-11 09:55:45', '2023-08-17 03:43:37'),
(4, 2, 1, NULL, '信用卡付款', 2, NULL, NULL, '2023-08-11 09:55:45', '2023-08-17 03:43:54'),
(5, 2, 1, NULL, '銀行轉帳', 3, NULL, NULL, '2023-08-11 09:55:45', '2023-08-17 03:44:37'),
(6, 2, 1, NULL, '電子支付', 4, NULL, NULL, '2023-08-11 09:55:45', '2023-08-17 03:44:51'),
(7, 2, 2, NULL, '處理中', 1, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:45:03'),
(8, 2, 2, NULL, '待出貨', 2, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:45:32'),
(9, 2, 2, NULL, '運送中', 3, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:45:45'),
(10, 2, 2, NULL, '收貨完成', 4, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:46:10'),
(11, 2, 2, NULL, '退貨中', 5, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:46:24'),
(12, 2, 2, NULL, '已關閉訂單', 6, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 03:46:35'),
(13, 2, 2, NULL, '無效訂單', 7, NULL, NULL, '2023-08-11 10:06:42', '2023-08-17 05:39:26'),
(14, 2, 2, NULL, '訂單確認', 8, NULL, NULL, '2023-08-18 06:13:47', '2023-10-23 12:37:36'),
(15, 2, 2, NULL, '平台出貨', 9, NULL, NULL, '2023-08-18 06:13:47', '2023-10-25 08:29:31'),
(34, 1, 0, NULL, '付款處理狀態', 0, NULL, NULL, '2023-08-11 09:52:29', '2023-08-17 03:42:41'),
(35, 2, 34, NULL, '侍貨到付款', 1, NULL, NULL, '2023-08-11 09:55:45', '2023-10-25 08:39:12'),
(36, 2, 34, NULL, '完成付款', 2, NULL, NULL, '2023-08-11 09:55:45', '2023-10-25 08:39:12'),
(37, 2, 34, NULL, '未完成付款', 3, NULL, NULL, '2023-08-11 09:55:45', '2023-10-25 08:39:12'),
(38, 2, 34, NULL, '貨到付款已完成', 4, NULL, NULL, '2023-08-11 09:55:45', '2023-10-25 08:39:12');

-- --------------------------------------------------------

--
-- 資料表結構 `on_sale`
--

CREATE TABLE `on_sale` (
  `o_id` int(3) NOT NULL COMMENT '特價商品流水號',
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `o_sort` int(11) DEFAULT NULL COMMENT '特價商品排名'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `on_sale`
--

INSERT INTO `on_sale` (`o_id`, `p_id`, `o_sort`) VALUES
(1, 3, NULL),
(2, 6, NULL),
(3, 8, NULL),
(4, 10, NULL),
(5, 14, NULL),
(6, 19, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `classid` int(3) NOT NULL COMMENT '產品類別',
  `p_name` varchar(200) NOT NULL COMMENT '產品名稱',
  `p_intro` varchar(200) DEFAULT NULL COMMENT '產品簡介',
  `p_price` int(11) DEFAULT NULL COMMENT '產品單價',
  `p_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '上架',
  `p_content` text DEFAULT NULL COMMENT '產品詳細規格',
  `p_date` timestamp NULL DEFAULT current_timestamp() COMMENT '產品輸入日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`p_id`, `classid`, `p_name`, `p_intro`, `p_price`, `p_open`, `p_content`, `p_date`) VALUES
(1, 21, 'i5十核 RTX 4060 Win11{天武殺手W} 電競電腦(i5-14400F/B760/16G/1TB SSD/WIFI)', '<ul id=\"categoryActivityInfo\" class=\"categoryActivityInfo gmclass\" style=\"min-height:50px\">         <li>i5-14400F 十核心</li>         <li>高速16GB記憶體</li>         <li>華碩RTX 4060獨顯</li>     </ul>', 24999, 1, '<div class=\"drop-box\">\r\n\r\n    <meta itemprop=\"description\" content=\"i7二十核Geforce RTX4060 WiN11{祥龍獻瑞}電競電腦(i7-14700F/B760/32G/1TB)\">\r\n    <p></p>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"longDesc\">\r\n\r\n        <body style=\"float: left\" marginwidth=\"0\" marginheight=\"0\">\r\n            <img src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/11563032co.jpg?t=1738983962288\" alt=\"\"\r\n                width=\"100%\" height=\"auto\"><a\r\n                href=\"https://www.momoshop.com.tw/category/LgrpCategory.jsp?l_code=4303700000\" target=\"_blank\"><img\r\n                    src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/DIY_INTEL_0.jpg?t=1738983962288\"\r\n                    alt=\"DIY全新功能 規格自由選 網頁目前僅支援電腦版使用 \" width=\"100%\" height=\"auto\"></a><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/i5-14400F-B760-16G---1TBGen4-RTX40608GB-X-500W80bron-Win11.jpg?t=1738983962288\"\r\n                alt=\"處理器 主機板 記憶體 儲存裝置 顯示卡 燒錄機 電源供應器 作業系統 500W 80銅牌 Win11 \" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/10045_m_1_4.jpg?t=1738983962288\"\r\n                alt=\"DIY電腦保固說明 1.此商品爲DIY組裝電腦非品牌電腦 2.購買均享有一年到府收送服務 3.各零組件均享有原廠保固 \" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/10045_m_1_5.jpg?t=1738983962288\"\r\n                alt=\"編輯相片並整理成簡報。Windows 11 具有您所需的\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/B760M-F-D4-CSM.jpg?t=1738983962288\"\r\n                alt=\"。Intel LGA 1700插槽支援第1412代 Intel Core 處理器\" width=\"100%\" height=\"auto\"><br><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/10045_m_1_11.jpg?t=1738983962288\"\r\n                alt=\"此商品顯示卡僅支援 HDMI及DisplayPort輸出,下單前請先確認您的螢幕是否支援上述接口\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/BHC-350.jpg?t=1738983962288\"\r\n                alt=\"散熱系統 擴充槽4個 支援顯卡最長 345mm 支援CPU空冷165mm 上置IO介面 \" width=\"100%\" height=\"auto\"><br><br><br><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/BHC-G30.jpg?t=1738983962288\"\r\n                alt=\"USB3.0 x1USB1.1 x2, HD Audio Mic,LED鈕\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/BHC-G47.jpg?t=1738983962288\"\r\n                alt=\"。USB3.0 x1USB1.1 x2, HD Audio Mic,LED鈕\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img1.momoshop.com.tw/expertimg/0011/563/032/mobile/POM03-M.jpg?t=1738983962288\"\r\n                alt=\"散熱系統 擴充槽4個 支援顯卡最長300mm ,支援CPU空冷185mm 側置IO介面 \" width=\"100%\" height=\"auto\"><br><br>\r\n\r\n\r\n        </body>\r\n    </div>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"vendordetailview specification\" style=\"\">\r\n        <!-- 20190709 jfchuang 常見問題集 start -->\r\n\r\n        <!--20190709 常見問題集 end-->\r\n\r\n        <div class=\"attributesArea\">\r\n            <div class=\"attributesListArea\">\r\n                <table id=\"attributesTable\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"ecTable\">\r\n                    <tbody>\r\n                        <tr>\r\n                            <th>品牌名稱</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>華碩平台</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n\r\n\r\n                        <tr>\r\n                            <th>記憶體</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>16GB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>SSD容量</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>1TB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>晶片</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>RTX 40系列</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>處理器</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>Intel Core i5</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>效能</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>501W~700W</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">保固期</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>1年保固期</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">商品規格</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>》處理器：Intel i5-14400F 十核心處理器(20M L3 Cache/1700腳位)<br><br>》主機板：華碩 B760M-F D4\r\n                                        -[本商品不含Windows作業軟體]<br><br>》顯示卡：華碩 RTX 4060 O8G\r\n                                        雙風扇<br>(提醒您：獨顯主機需將螢幕接線在顯卡輸出埠上，才能正常開機)<br><br>》記憶體：16GB DDR4-3200 記憶體(16G x1)\r\n                                        (2個DDR4 DIMM,\r\n                                        最高可支援到64GB)<br>※部份記憶體於BIOS下預設頻率可能與實際商品規格不符,可參考各主機板原廠網頁教學開啟XMP調整。<br><br>》硬碟：\r\n                                        無<br><br>》SSD固態硬碟：1TB M.2 Gen4<br><br>》機殼： 依選取規格出貨 (BHC G47 白色\r\n                                        RGB三風扇為定光無切換關閉功能)<br><br>》電源供應器：500W 80Plus銅牌\r\n                                        <br><br>》光碟機：無<br><br>》作業系統：Windows 11 中文\r\n                                        家用隨機版<br>(商品內含作業系統為實際包裝商品，出貨時會先安裝完成；提醒您：因軟體啟用後將影響換貨權益,請協助於鑑賞期過後再拆封並輸入金鑰啟用。※註：未啟用前除限制部份個人化設定外,不影響其它完整功能。)<br><br>》特色：商品支援無線WiFi功能，收到後請將配件天線接上，開機後連線家中無線分享器，免接網路線立即上網。<br><br>藍牙驅動程式-下載網址:\r\n                                        https://ppt.cc/flKWLx\r\n                                        (出貨時已安裝驅動，如需自行安裝作業系統,請下載此版驅動程式)<br><br>》保固：整機一年內故障免費到府收送服務(非到府維修)，請保留原箱及箱內包材以便物流取件。<br>※各單獨零件仍享有原廠保固服務，一年後故障可自行拆裝零件後個別送修，保固條件及時限依原廠規定。<br><br>》讀卡機:\r\n                                        無<br><br>》鍵盤滑鼠組: 無<br><br>》液晶顯示器:\r\n                                        無<br><br>※本商品為整機出貨，除主機外僅提供必要商品彩盒、配件等。註:彩盒為外盒部份，不含內盒或包材<br><br>※以上規格資料若有任何錯誤，以原廠所公佈資料為準<br><br>※換貨時若遇該零組件原廠缺貨或者停產，我們會以同等不同品牌的零組件進行替換<br><br>※無到府安裝服務<br><br>審閱期退貨條件：<br><br>退回商品必須是全新狀態(不得有刮傷)且有完整的包裝(主商品、附件:驅動程式、應用軟體(不得拆封)、作業系統軟體(不得拆封註冊)、電源線、變壓器、包裝包含外紙箱、內紙箱(本商品包裝紙箱皆有序號管理，恕原廠及特約廠商無法提供折扣退款金額)、配件紙箱、保麗龍、保護袋、贈品等廠商及所有附隨文件或資料之完整性，否則恕不接受退訂。\r\n                                    </li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n            </div><br>\r\n\r\n\r\n\r\n\r\n        </div>\r\n\r\n    </div>\r\n    <style>\r\n        .ecTitle {\r\n            font-size: 18px;\r\n            font-weight: bold;\r\n            color: #009f9f;\r\n            margin: 5px 0 5px 0;\r\n        }\r\n\r\n        table {\r\n            border-collapse: separate;\r\n            text-indent: initial;\r\n        }\r\n\r\n        .ecTable {\r\n            width: 100%;\r\n            border: 1px solid gray;\r\n        }\r\n\r\n        .ecTable td {\r\n            border: 1px solid gray;\r\n            font-size: 14px\r\n        }\r\n\r\n        img {\r\n            overflow-clip-margin: content-box;\r\n            overflow: clip;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table tr:first-child td ul li a {\r\n            margin: 0px;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td a {\r\n            font: 15px / 23px Helvetica;\r\n            color: #3366FF;\r\n        }\r\n\r\n        a {\r\n            cursor: pointer;\r\n            text-decoration: none;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table th {\r\n            width: 30%;\r\n            height: 25px;\r\n            padding: 5px;\r\n            line-height: 25px;\r\n            background-color: #eeeeee;\r\n            text-align: center;\r\n            font-weight: bold;\r\n            padding: 4px 10px;\r\n            border-top: 1px solid #999999;\r\n            font: 15px / 23px Helvetica;\r\n            vertical-align: top;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul li {\r\n            padding: 5px;\r\n            letter-spacing: 1px;\r\n            color: #4c4c4c;\r\n            border: 0px;\r\n            display: inline-block;\r\n            word-break: break-word;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul {\r\n            background-color: transparent;\r\n            margin: 0px;\r\n            padding: 0px;\r\n        }\r\n\r\n        .categoryActivityInfo li {\r\n            width: 380px;\r\n            height: 23px;\r\n            list-style-position: inside;\r\n            font: 13px / 23px Helvetica;\r\n            color: #585858;\r\n            overflow: hidden;\r\n        }\r\n\r\n        li {\r\n            display: list-item;\r\n            text-align: -webkit-match-parent;\r\n            unicode-bidi: isolate;\r\n        }\r\n\r\n        .categoryActivityInfo li::marker {\r\n            unicode-bidi: isolate;\r\n            font-variant-numeric: tabular-nums;\r\n            text-transform: none;\r\n            text-indent: 0px !important;\r\n            text-align: start !important;\r\n            text-align-last: start !important;\r\n        }\r\n    </style>', '2025-01-23 01:45:02'),
(3, 21, 'i7二十核Geforce RTX4060 WiN11{祥龍獻瑞}電競電腦(i7-14700F/B760/32G/1TB)', '<ul id=\"categoryActivityInfo\" class=\"categoryActivityInfo gmclass\">         <li>二十核心處理器</li>         <li>微星 RTX4060 顯示卡</li>         <li>微星 GEN4 1TB</li>     </ul>', 30999, 1, '<div class=\"drop-box\">\r\n\r\n    <meta itemprop=\"description\" content=\"i7二十核Geforce RTX4060 WiN11{祥龍獻瑞}電競電腦(i7-14700F/B760/32G/1TB)\">\r\n    <p></p>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"longDesc\">\r\n\r\n        <body style=\"float: left\" marginwidth=\"0\" marginheight=\"0\">\r\n            <img src=\"https://img1.momoshop.com.tw/expertimg/0011/871/737/mobile/15456.jpg?t=1732880169285\" alt=\"\"\r\n                width=\"100%\" height=\"auto\"><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/2.jpg?t=1732880169285\"\r\n                alt=\"散熱器 POWER 作業系統\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/C7.JPG?t=1732880169285\"\r\n                alt=\"DIY電腦保固說明 1.此商品爲DIY組裝電腦非品牌電腦 2.購買均享有一年到府收送服務 3.各零組件均享有原廠保固 \" width=\"100%\" height=\"auto\"><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/CC2.jpg?t=1732880169285\"\r\n                alt=\"Intel Core 第14 代\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/123.jpg?t=1732880169285\"\r\n                alt=\"遊戲、直播及創作。GeForce RTX 4060採用超高效NVIDIA Ada Lovelace架\" width=\"100%\" height=\"auto\"><br><br><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/MSI_FORGE_M100R.jpg?t=1732880169285\"\r\n                alt=\"最多可安裝6個系統風扇,為整個系統提供通風和穩定的性能。\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img2.momoshop.com.tw/expertimg/0011/871/737/mobile/C6.jpg?t=1732880169285\"\r\n                alt=\"如主機顯卡無所需接口,請自行購買轉接頭線,主機不會附贈螢幕線材。\" width=\"100%\" height=\"auto\"><br><img><br><br>\r\n        </body>\r\n    </div>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"vendordetailview specification\" style=\"\">\r\n        <!-- 20190709 jfchuang 常見問題集 start -->\r\n\r\n        <!--20190709 常見問題集 end-->\r\n\r\n        <div class=\"attributesArea\">\r\n            <div class=\"attributesListArea\">\r\n                <table id=\"attributesTable\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"ecTable\">\r\n                    <tbody>\r\n                        <tr>\r\n                            <th>品牌名稱</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>微星平台</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n\r\n\r\n                        <tr>\r\n                            <th>記憶體</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>32GB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>SSD容量</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>1TB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>晶片</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>RTX 40系列</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>處理器</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>Intel Core i7</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>效能</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>501W~700W</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \" rowspan=\"2\">保固期</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>1年保固期</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>零件均享各原廠保固，購買後提供一年免費到府收送件</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">商品規格</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>處理器：INTEL I7-14700F 二十核心處理器<br>主機板：微星 B760M-E D4 主機板<br>記憶體：威剛 32G\r\n                                        DDR4/3200<br>固態硬碟：微星 GEN4 1TB M.2 SSD<br>獨立顯示卡：MSI GeForce RTX4060 VENTUS 2X 8G\r\n                                        OC<br>電源供應器：600W(微星電源供應器)<br>機殼:微星MAG FORGE M100R<br>作業系統：Windows 11\r\n                                        HOME<br>保固：一年保固(保修)<br>--------------------------------------<br>※本機器不含鍵盤滑鼠組需自行加購。<br>※如遇零件原廠缺貨或停產，將更換同等級零件進行替換<br>※作業系統會放在配件包內，請勿丟棄請永久保存，建議鑑賞期過後再開封使用<br>※以上規格如任何錯誤依供應商公告為準\r\n                                    </li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n            </div><br>\r\n\r\n\r\n\r\n\r\n        </div>\r\n\r\n\r\n    </div>\r\n    <style>\r\n        .ecTitle {\r\n            font-size: 18px;\r\n            font-weight: bold;\r\n            color: #009f9f;\r\n            margin: 5px 0 5px 0;\r\n        }\r\n\r\n        table {\r\n            border-collapse: separate;\r\n            text-indent: initial;\r\n        }\r\n\r\n        .ecTable {\r\n            width: 100%;\r\n            border: 1px solid gray;\r\n        }\r\n\r\n        .ecTable td {\r\n            border: 1px solid gray;\r\n            font-size: 14px\r\n        }\r\n\r\n        img {\r\n            overflow-clip-margin: content-box;\r\n            overflow: clip;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table tr:first-child td ul li a {\r\n            margin: 0px;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td a {\r\n            font: 15px / 23px Helvetica;\r\n            color: #3366FF;\r\n        }\r\n\r\n        a {\r\n            cursor: pointer;\r\n            text-decoration: none;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table th {\r\n            width: 30%;\r\n            height: 25px;\r\n            padding: 5px;\r\n            line-height: 25px;\r\n            background-color: #eeeeee;\r\n            text-align: center;\r\n            font-weight: bold;\r\n            padding: 4px 10px;\r\n            border-top: 1px solid #999999;\r\n            font: 15px / 23px Helvetica;\r\n            vertical-align: top;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul li {\r\n            padding: 5px;\r\n            letter-spacing: 1px;\r\n            color: #4c4c4c;\r\n            border: 0px;\r\n            display: inline-block;\r\n            word-break: break-word;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul {\r\n            background-color: transparent;\r\n            margin: 0px;\r\n            padding: 0px;\r\n        }\r\n\r\n        .categoryActivityInfo li {\r\n            width: 380px;\r\n            height: 23px;\r\n            list-style-position: inside;\r\n            font: 13px / 23px Helvetica;\r\n            color: #585858;\r\n            overflow: hidden;\r\n        }\r\n\r\n        li {\r\n            display: list-item;\r\n            text-align: -webkit-match-parent;\r\n            unicode-bidi: isolate;\r\n        }\r\n\r\n        .categoryActivityInfo li::marker {\r\n            unicode-bidi: isolate;\r\n            font-variant-numeric: tabular-nums;\r\n            text-transform: none;\r\n            text-indent: 0px !important;\r\n            text-align: start !important;\r\n            text-align-last: start !important;\r\n        }\r\n    </style>', '2025-01-23 01:48:48'),
(4, 21, 'i7二十核GeForce RTX 4060Ti{聖塔主教}AORUS電競水冷主機(I7-14700F/B760/32G D5/1TB/WIFI)', '<ul id=\"categoryActivityInfo\" class=\"categoryActivityInfo gmclass\" style=\"min-height:50px\">         <li>20核水冷電競</li>         <li>32G DDR5電競</li>         <li>1T M.2 Gen4</li>     </ul>', 38271, 1, '<div class=\"drop-box\">\r\n\r\n    <meta itemprop=\"description\" content=\"i7二十核GeForce RTX 4060Ti{聖塔主教}AORUS電競水冷主機(I7-14700F/B760/32G D5/1TB/WIFI)\">\r\n    <p></p>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"longDesc\">\r\n\r\n        <body style=\"float: left\" marginwidth=\"0\" marginheight=\"0\">\r\n            <img src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/BN_I7-14700F_DRX70.jpg?t=1739179195200\"\r\n                alt=\"處理器 主機板 記憶體 儲存裝置 顯示卡 燒錄機 電源供應器 作業系統 650W銅 \" width=\"100%\" height=\"auto\"><br><br><img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/I7-14700F.jpg?t=1739179195200\"\r\n                alt=\"大的調校與超頻工具套件來增強 CPU 效能。支援 Intel 700 系列晶片組\" width=\"100%\" height=\"auto\"><br><br><img\r\n                src=\"//img4.momoshop.com.tw/expertimg/0012/988/671/mobile/COOL_darkflash_DN240_BK.jpg?t=1739179195200\"\r\n                alt=\"注意購買前請先應認您所安裝主辦法、相關保體搭載DW ARGB 3Pin介面\" width=\"100%\" height=\"auto\"><br><br><img\r\n                src=\"//img4.momoshop.com.tw/expertimg/0012/988/671/mobile/COOL_darkflash_DN240_WH.jpg?t=1739179195200\"\r\n                alt=\"注意購買前請先應認您所安裝主辦法、相關保體搭載DW ARGB 3Pin介面\" width=\"100%\" height=\"auto\"><br>&nbsp;&nbsp;<img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/GIGABYTE_B760M_AORUS_ELITE_AX_D5.jpg?t=1739179195200\"\r\n                alt=\"電腦技術發展一日千里,技克憑藉優異的研發能力緊跟最新趨勢,為消費者提供先進的功能和最新的技術。技三主機板搭載先進的電源供應解決方案、最\" width=\"100%\"\r\n                height=\"auto\">&nbsp;&nbsp; &nbsp;<img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/DarkFlash_DRX70_MESH.jpg?t=1739179195200\"\r\n                alt=\"編殻DRX70 鐵纲版沉穩黑 風扇C7 黑 散熱器DXv2 240 黑\" width=\"100%\" height=\"auto\"><br><img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/PDF.jpg?t=1739179195200\"\r\n                alt=\"DIY電腦保固說明 1.此商品爲DIY組裝電腦非品牌電腦 2.購買均享有一年到府收送服務 3.各零組件均享有原廠保固 \" width=\"100%\" height=\"auto\"><img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/Warranty.jpg?t=1739179195200\"\r\n                alt=\"2.組裝不當,自行拆裝,任意變更規格或非原出貨之配件所引起之故障與損壞\" width=\"100%\" height=\"auto\"><br>&nbsp;<img\r\n                src=\"https://img4.momoshop.com.tw/expertimg/0012/988/671/mobile/VGL.jpg?t=1739179195200\"\r\n                alt=\"若螢幕接頭與主機接頭不吻合,需另購轉接頭\" width=\"100%\" height=\"auto\"><br><br><br>\r\n\r\n\r\n        </body>\r\n    </div>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"vendordetailview specification\" style=\"\">\r\n        <!-- 20190709 jfchuang 常見問題集 start -->\r\n\r\n        <!--20190709 常見問題集 end-->\r\n\r\n        <div class=\"attributesArea\">\r\n            <div class=\"attributesListArea\">\r\n                <table id=\"attributesTable\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"ecTable\">\r\n                    <tbody>\r\n                        <tr>\r\n                            <th>品牌名稱</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>技嘉平台</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n\r\n\r\n                        <tr>\r\n                            <th>記憶體</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>32GB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>SSD容量</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>1TB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>晶片</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>RTX 40系列</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>處理器</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>Intel Core i7</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>效能</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>501W~700W</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \" rowspan=\"2\">保固期</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>1年保固期</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>三年硬體保固、一年免費到府收送 (機殼風扇、贈品及風扇為耗材,軟體不在此保固範圍)</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">商品規格</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>中央處理器：Intel Core I7-14700F 超強二十核心<br>散熱器：darkFlash DN240 美型水冷散熱器 白/黑<br>主機板：技嘉\r\n                                        B760M AORUS ELITE AX 信仰晶片組<br>記憶體：威剛XPG 32G/DDR5 6400(16G*2)\r\n                                        電競超頻記憶體<br>固態硬碟：美光or威剛 1TB Gen4 M.2 PCIe SSD 高速固態<br>顯示卡：技嘉 GeForce RTX 4060Ti\r\n                                        OC 8GD 電競顯卡<br>電源供應器：大供電 650W 80銅牌<br>機殼：DarkFlash DRX70 MESH\r\n                                        白/黑<br>燒錄機：無<br>輸出介面：HDMI / DisplayPort<br><br>作業系統：無，需另行購買正版作業系統使用。<br>保\r\n                                        固：一年免費到府收送，三年硬體保固\r\n                                        (機殼及風扇皆為耗材，軟體、贈品不在此保固範圍)<br><br>商品主圖為示意圖，請以實際規格為主。<br><br><br>備\r\n                                        註：<br>※商品規格文案為示意圖，以實際出貨商品為主。<br>※本商品為組裝整機出貨，不含零組件內盒包材，僅提供部分商品外彩盒、配件包。<br>※不包含軟體及鍵盤滑鼠組。<br>※機殼玻璃側板不在保固之中，請務必小心使用。<br>※機器如遇零組件短缺之情況，各組件將以同等(或以上)規格組件出貨。<br>※無到府安裝服務。<br>※以上等規格、資料、圖片若有任何錯誤，以原廠官方網站所公佈資料為準。<br>※實際傳輸速度會因您的系統效能(ex:\r\n                                        硬體, 軟體,\r\n                                        使用方式...)而有所不同。<br>※每台主機都經過硬體工程師嚴格測試，是您值得信賴的好品質。<br><br>貼心小提醒：此商品建議安裝Window10以上系統\r\n                                        (不支援Windows7)<br>※本商品不含螢幕傳輸線、螢幕轉接頭，請另購買。<br><br>審閱期退貨條件：<br>退回商品必須是全新狀態(不得有刮傷)且有完整的包裝<br>(主商品、附件:驅動程式、應用軟體(不得拆封)、作業系統軟體(不得拆封註冊)、<br>電源線、變壓器、包裝包含外紙箱、內紙箱(本商品包裝紙箱皆有序號管理，<br>恕原廠及特約廠商無法提供折扣退款金額)、配件紙箱、保麗龍、保護袋、<br>贈品等廠商及所有附隨文件或資料之完整性，否則恕不接受退訂。\r\n                                    </li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>認證字號</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>無須商檢</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n            </div><br>\r\n\r\n\r\n\r\n\r\n        </div>\r\n    </div>\r\n    <style>\r\n        .ecTitle {\r\n            font-size: 18px;\r\n            font-weight: bold;\r\n            color: #009f9f;\r\n            margin: 5px 0 5px 0;\r\n        }\r\n\r\n        table {\r\n            border-collapse: separate;\r\n            text-indent: initial;\r\n        }\r\n\r\n        .ecTable {\r\n            width: 100%;\r\n            border: 1px solid gray;\r\n        }\r\n\r\n        .ecTable td {\r\n            border: 1px solid gray;\r\n            font-size: 14px\r\n        }\r\n\r\n        img {\r\n            overflow-clip-margin: content-box;\r\n            overflow: clip;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table tr:first-child td ul li a {\r\n            margin: 0px;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td a {\r\n            font: 15px / 23px Helvetica;\r\n            color: #3366FF;\r\n        }\r\n\r\n        a {\r\n            cursor: pointer;\r\n            text-decoration: none;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table th {\r\n            width: 30%;\r\n            height: 25px;\r\n            padding: 5px;\r\n            line-height: 25px;\r\n            background-color: #eeeeee;\r\n            text-align: center;\r\n            font-weight: bold;\r\n            padding: 4px 10px;\r\n            border-top: 1px solid #999999;\r\n            font: 15px / 23px Helvetica;\r\n            vertical-align: top;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul li {\r\n            padding: 5px;\r\n            letter-spacing: 1px;\r\n            color: #4c4c4c;\r\n            border: 0px;\r\n            display: inline-block;\r\n            word-break: break-word;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul {\r\n            background-color: transparent;\r\n            margin: 0px;\r\n            padding: 0px;\r\n        }\r\n\r\n        .categoryActivityInfo li {\r\n            width: 380px;\r\n            height: 23px;\r\n            list-style-position: inside;\r\n            font: 13px / 23px Helvetica;\r\n            color: #585858;\r\n            overflow: hidden;\r\n        }\r\n\r\n        li {\r\n            display: list-item;\r\n            text-align: -webkit-match-parent;\r\n            unicode-bidi: isolate;\r\n        }\r\n\r\n        .categoryActivityInfo li::marker {\r\n            unicode-bidi: isolate;\r\n            font-variant-numeric: tabular-nums;\r\n            text-transform: none;\r\n            text-indent: 0px !important;\r\n            text-align: start !important;\r\n            text-align-last: start !important;\r\n        }\r\n    </style>', '2025-01-23 01:52:08'),
(5, 21, 'i5十核RTX4060獨顯電腦(i5-13400/16G/1TB/RTX4060/H-S501MER-513400002W)', '<ul id=\"categoryActivityInfo\" class=\"categoryActivityInfo gmclass\" style=\"min-height:50px\">         <li>13代CPU+RTX4060</li>         <li>幾何建築美學設計外觀</li>         <li>新一代AI降噪技術</li>     </ul>', 31990, 1, '<div class=\"drop-box\">\r\n\r\n    <meta itemprop=\"description\" content=\"i5十核RTX4060獨顯電腦(i5-13400/16G/1TB/RTX4060/H-S501MER-513400002W)\">\r\n    <p></p>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"longDesc\">\r\n\r\n        <body style=\"float: left\" marginwidth=\"0\" marginheight=\"0\"><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/PC-BN.jpg\" alt=\"\"><br></span></strong><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_01.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_02.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_03.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_04.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_05.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_06.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_07.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_08.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_09.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/S501MER_10.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/PC-01.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/PC-02.jpg\" alt=\"\"><br><img\r\n                src=\"//img3.momoshop.com.tw/expertimg/0012/774/178/2024asus.jpg\" alt=\"\"></span></body>\r\n    </div>\r\n    <p class=\"ecTitle\">商品特色</p>\r\n    <div class=\"vendordetailview specification\" style=\"\">\r\n        <!-- 20190709 jfchuang 常見問題集 start -->\r\n\r\n        <!--20190709 常見問題集 end-->\r\n\r\n        <div class=\"attributesArea\">\r\n            <div class=\"attributesListArea\">\r\n                <table id=\"attributesTable\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"ecTable\">\r\n                    <tbody>\r\n                        <tr>\r\n                            <th>品牌名稱</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>ASUS 華碩</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n\r\n\r\n                        <tr>\r\n                            <th>作業系統</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>Windows 11</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>記憶體</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>16GB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>SSD容量</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>1TB</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>類型</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>家用桌上型</li>\r\n                                    <li>DDR5</li>\r\n                                    <li>10核心</li>\r\n                                    <li>獨立顯卡</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>商品狀態</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>全新品</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>晶片</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>RTX 40系列</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>處理器</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>Intel Core i5</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">保固期</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>3年保固期</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th style=\"border-top: 1px solid #999999; \">商品規格</th>\r\n                            <td style=\"border-top: 1px solid #999999; \">\r\n                                <ul>\r\n                                    <li>H-S501MER-513400002W<br>處理器CPU：Intel Core i5-13400 Processor 2.5GHz (20M Cache,\r\n                                        up to 4.6GHz, 10 cores)<br>記憶體：16GB DDR5 U-DIMM<br>Memory speed is 5600MHz, but\r\n                                        run at 4000~4400MHz.<br>顯示卡:NVIDIA GeForce RTX4060 DUAL 8GB GDDR6：3xDP, 1x\r\n                                        HDMI<br>硬碟：1TB M.2 2280 NVMe PCIe 4.0 SSD<br>光碟機：無<br>無線網路：Wi-Fi 6(802.11ax)\r\n                                        (Dual band) 1*1 + Bluetooth 5.2 Wireless Card<br>Rear I/O Port:<br>1x RJ45\r\n                                        Gigabit Ethernet<br>1x HDMI 2.1b<br>1x VGA Port<br>1x Display port 1.4<br>3 x\r\n                                        Audio jacks<br>2x USB 3.2 Gen 1 Type-A<br>Front I/O Port:<br>1x 3.5mm combo\r\n                                        audio jack<br>1x USB 3.2 Gen 2 Type-C<br>3x USB 3.2 Gen 1\r\n                                        Type-A<br>電腦滑鼠：有<br>電腦鍵盤：有<br>作業系統：Windows 11 Home<br>電源：500W power supply (80+\r\n                                        Bronze, peak 550W)<br>尺寸:16.00 x 31.89 x 36.78 cm<br>重量:5.90\r\n                                        kg<br>保固：三年保固<br><br>備註：以上規格僅供參考，如有任何問題，請依原廠公告為主。</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <th>認證字號</th>\r\n                            <td>\r\n                                <ul>\r\n                                    <li>商檢字號：R31018</li>\r\n                                </ul>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>\r\n            </div><br>\r\n\r\n\r\n\r\n\r\n        </div>\r\n    </div>\r\n    <style>\r\n        .ecTitle {\r\n            font-size: 18px;\r\n            font-weight: bold;\r\n            color: #009f9f;\r\n            margin: 5px 0 5px 0;\r\n        }\r\n\r\n        table {\r\n            border-collapse: separate;\r\n            text-indent: initial;\r\n        }\r\n\r\n        .ecTable {\r\n            width: 100%;\r\n            border: 1px solid gray;\r\n        }\r\n\r\n        .ecTable td {\r\n            border: 1px solid gray;\r\n            font-size: 14px\r\n        }\r\n\r\n        img {\r\n            overflow-clip-margin: content-box;\r\n            overflow: clip;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table tr:first-child td ul li a {\r\n            margin: 0px;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td a {\r\n            font: 15px / 23px Helvetica;\r\n            color: #3366FF;\r\n        }\r\n\r\n        a {\r\n            cursor: pointer;\r\n            text-decoration: none;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table th {\r\n            width: 30%;\r\n            height: 25px;\r\n            padding: 5px;\r\n            line-height: 25px;\r\n            background-color: #eeeeee;\r\n            text-align: center;\r\n            font-weight: bold;\r\n            padding: 4px 10px;\r\n            border-top: 1px solid #999999;\r\n            font: 15px / 23px Helvetica;\r\n            vertical-align: top;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul li {\r\n            padding: 5px;\r\n            letter-spacing: 1px;\r\n            color: #4c4c4c;\r\n            border: 0px;\r\n            display: inline-block;\r\n            word-break: break-word;\r\n        }\r\n\r\n        .specification .attributesArea .attributesListArea table td ul {\r\n            background-color: transparent;\r\n            margin: 0px;\r\n            padding: 0px;\r\n        }\r\n\r\n        .categoryActivityInfo li {\r\n            width: 380px;\r\n            height: 23px;\r\n            list-style-position: inside;\r\n            font: 13px / 23px Helvetica;\r\n            color: #585858;\r\n            overflow: hidden;\r\n        }\r\n\r\n        li {\r\n            display: list-item;\r\n            text-align: -webkit-match-parent;\r\n            unicode-bidi: isolate;\r\n        }\r\n\r\n        .categoryActivityInfo li::marker {\r\n            unicode-bidi: isolate;\r\n            font-variant-numeric: tabular-nums;\r\n            text-transform: none;\r\n            text-indent: 0px !important;\r\n            text-align: start !important;\r\n            text-align-last: start !important;\r\n        }\r\n    </style>', '2025-01-23 01:56:16'),
(6, 21, 'i5 RTX4060電競電腦(PO3-650/i5-13400F/32G/1TB SSD/RTX4060-8G/W11)', NULL, 39900, 1, NULL, '2025-01-23 01:58:21'),
(7, 21, 'i5六核GeForce RTX 3050{天權鬥士}電競電腦(i5-12400F/H610/16G/512G)', NULL, 14346, 1, NULL, '2025-01-23 03:17:30'),
(8, 21, 'U7廿核GeForce RTX 4070{希莫鳥L6FC}水冷電競電腦(U7 265K/Z890/32G D5/1TB/WIFI)', NULL, 51884, 1, NULL, '2025-01-23 03:19:30'),
(10, 21, 'U9廿四核GeForce RTX 4070{卡俄斯L82C}水冷電競電腦(U9 285K/Z890/64G D5/1TB/WIFI)', NULL, 65741, 1, NULL, '2025-01-23 03:33:18'),
(11, 21, 'i9 RTX4060Ti 二十四核電競電腦(PO5-650/i9-13900KF/64G/2TB+2TB SSD/RTX4060Ti-8G/W11)', NULL, 94900, 1, NULL, '2025-01-23 03:35:47'),
(12, 21, 'R7八核GeForce RTX 4080S Win11{破曉自由W}海景水冷電競機(R7-9800X3D/X870/32G D5/1TB/WIFI)', NULL, 85949, 1, NULL, '2025-01-23 03:39:55'),
(13, 21, 'i5 十四核 RTX 4060 Ti{水冷戰隊}電競水冷電腦(i5-14500/B760/32G D5/1TB/WIFI)', NULL, 30999, 1, NULL, '2025-01-23 03:41:47'),
(14, 21, 'R9十二核RTX 4070S Win11{魔劍門W}電競機(R9 9900X/X870/64G D5/2TB/WiFi7)', NULL, 74027, 1, NULL, '2025-01-23 03:43:34'),
(15, 21, 'R9 十六核 RTX4070Ti S {黑克}電競機(R9-9950X/X870/32G_D5/2TB)', NULL, 69749, 1, NULL, '2025-01-23 03:45:26'),
(16, 25, 'Galaxy S25 Ultra 5G 6.9吋(12G/512G/高通驍龍8 Elite/2億鏡頭畫素/AI手機)', NULL, 47900, 1, NULL, '2025-02-02 05:32:12'),
(17, 111, '徠卡 D-Lux 8 便攜式數位相機 旅行四件組 主機+256G記憶卡+金剛爪腳架+相機肩背包(公司貨)', NULL, 61600, 1, NULL, '2025-02-02 05:40:19'),
(18, 139, 'Panasonic 國際牌 77型4K連網OLED顯示器(TH-77LZ2000W)', NULL, 98999, 1, NULL, '2025-02-02 06:33:17'),
(19, 144, 'HUAWEI 華為 WATCH Ultimate Design 48mm 尊享款 運動健康智慧手錶', NULL, 88888, 1, NULL, '2025-02-02 06:36:13'),
(20, 122, '【Kingston 金士頓】KC3000 2TB M.2 2280 PCIe 4.0 ssd固態硬碟 SKC3000D/2048G 讀 7000M/寫 7000M', NULL, 3999, 1, NULL, '2025-02-02 08:38:29');

-- --------------------------------------------------------

--
-- 資料表結構 `product_img`
--

CREATE TABLE `product_img` (
  `img_id` int(11) NOT NULL COMMENT '圖檔編號',
  `p_id` int(10) NOT NULL COMMENT '產品編號',
  `img_file` varchar(100) NOT NULL COMMENT '圖檔名稱',
  `sort` int(2) NOT NULL COMMENT '圖片順序',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product_img`
--

INSERT INTO `product_img` (`img_id`, `p_id`, `img_file`, `sort`, `create_date`) VALUES
(1, 1, '11563032_R.webp', 1, '2025-01-23 01:47:01'),
(2, 1, '11563032_R1.webp', 2, '2025-01-23 01:47:01'),
(3, 3, '11871737_R.webp', 1, '2025-01-23 01:51:00'),
(4, 3, '11871737_OR.webp', 2, '2025-01-23 01:51:00'),
(5, 4, '12988671_R1.webp', 1, '2025-01-23 01:53:13'),
(6, 4, '12988671_OR.webp', 2, '2025-01-23 01:53:13'),
(7, 5, '12774178_R.webp', 1, '2025-01-23 01:57:15'),
(8, 5, '12774178_R1.webp', 2, '2025-01-23 01:57:15'),
(9, 6, '11824203_R.webp', 1, '2025-01-23 01:58:56'),
(10, 6, '11824203_R1.webp', 2, '2025-01-23 01:58:56'),
(11, 7, '12688375_R.webp', 1, '2025-01-23 03:18:11'),
(12, 7, '12688375_OR.webp', 2, '2025-01-23 03:18:11'),
(13, 8, '13477236_R.webp', 1, '2025-01-23 03:32:02'),
(14, 8, '13477236_01_001_R.webp', 2, '2025-01-23 03:32:02'),
(15, 8, '13477236_01_002_R.webp', 3, '2025-01-23 03:32:19'),
(16, 10, '13428063_R.webp', 1, '2025-01-23 03:33:41'),
(17, 10, '13428063_01_001_R.webp', 2, '2025-01-23 03:34:08'),
(18, 10, '13428063_01_002_R.webp', 3, '2025-01-23 03:34:08'),
(19, 11, '13196974_R.webp', 1, '2025-01-23 03:36:22'),
(20, 11, '13196974_OR.webp', 2, '2025-01-23 03:36:22'),
(21, 12, '13520902_R.webp', 1, '2025-01-23 03:40:39'),
(22, 12, '13520902_R1.webp', 2, '2025-01-23 03:40:39'),
(23, 13, '11806210_R.webp', 1, '2025-01-23 03:42:23'),
(24, 13, '11806210_R1.webp', 1, '2025-01-23 03:42:23'),
(25, 14, '13573655_R.webp', 1, '2025-01-23 03:44:02'),
(26, 14, '13573655_01_002_R.webp', 2, '2025-01-23 03:44:02'),
(27, 15, '13368031_R.webp', 1, '2025-01-23 03:45:55'),
(28, 15, '13368031_OR.webp', 2, '2025-01-23 03:45:55'),
(29, 16, '13636509_R.webp', 1, '2025-02-02 05:34:52'),
(30, 16, '13636509_R4.webp', 2, '2025-02-02 05:34:52'),
(31, 17, '13649205_R.webp', 1, '2025-02-02 05:41:09'),
(32, 17, '13649205_R5.webp', 2, '2025-02-02 05:41:09'),
(33, 18, '10434455_R.webp', 1, '2025-02-02 06:34:01'),
(34, 18, '10434455_OR.webp', 2, '2025-02-02 06:34:01'),
(35, 19, '12501501_R.webp', 1, '2025-02-02 06:36:48'),
(36, 19, '12501501_OR.webp', 2, '2025-02-02 06:36:48'),
(37, 20, '9573275_R.webp', 1, '2025-02-02 08:39:24'),
(38, 20, '9573275_OR.webp', 2, '2025-02-02 08:39:24');

-- --------------------------------------------------------

--
-- 資料表結構 `pyclass`
--

CREATE TABLE `pyclass` (
  `classid` int(3) NOT NULL COMMENT '產品類別',
  `level` int(2) NOT NULL COMMENT '所在層級',
  `fonticon` varchar(30) NOT NULL COMMENT '字型圖示',
  `cname` varchar(30) NOT NULL COMMENT '類別名稱',
  `sort` int(3) NOT NULL COMMENT '列表排序',
  `uplink` int(3) NOT NULL COMMENT '上層連結',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '建立時間與更新時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- 傾印資料表的資料 `pyclass`
--

INSERT INTO `pyclass` (`classid`, `level`, `fonticon`, `cname`, `sort`, `uplink`, `create_date`) VALUES
(1, 1, 'fa-desktop', '電腦及配件', 1, 0, '2025-01-22 07:24:55'),
(2, 1, 'fa-mobile-alt', '手機及配件', 2, 0, '2025-01-22 07:27:56'),
(3, 1, 'fa-camera', '相機及攝影器材', 3, 0, '2025-01-22 07:28:14'),
(21, 2, 'fa-desktop', '桌上型電腦', 1, 1, '2025-01-22 07:29:33'),
(22, 2, 'fa-laptop', '筆記型電腦', 2, 1, '2025-01-22 07:29:55'),
(23, 2, 'fa-tv', '顯示器', 3, 1, '2025-01-22 07:30:12'),
(24, 2, 'fa-keyboard', '鍵盤與滑鼠', 4, 1, '2025-01-22 07:30:30'),
(25, 2, 'fa-mobile-alt', '智慧型手機', 1, 2, '2025-01-22 07:47:24'),
(26, 2, 'fa-charging-station', '充電器與線材', 2, 2, '2025-01-22 07:47:38'),
(27, 2, 'fa-headphones', '藍牙耳機', 3, 2, '2025-01-22 07:47:52'),
(28, 2, 'fa-shield-alt', '保護殼與保護貼', 4, 2, '2025-01-22 07:48:19'),
(29, 2, 'fa-battery-full', '行動電源', 5, 2, '2025-01-22 07:48:36'),
(111, 2, 'fa-camera', '數位相機', 1, 3, '2025-01-22 07:49:18'),
(112, 2, 'fa-camera-retro', '攝影機', 2, 3, '2025-01-22 07:49:40'),
(113, 2, 'fa-icons', '攝影周邊', 3, 3, '2025-01-22 07:49:59'),
(140, 2, 'fa-fan', '電風扇', 2, 118, '2025-01-22 07:52:44'),
(141, 2, 'fa-blender', '廚房家電', 3, 118, '2025-01-22 07:53:03'),
(142, 2, 'fa-washing-machine', '洗衣機', 4, 118, '2025-01-22 07:53:25'),
(143, 2, 'fa-lightbulb', '智能家電', 5, 118, '2025-01-22 07:53:45'),
(118, 1, 'fa-blender', '家用電器', 4, 0, '2025-01-22 07:26:51'),
(139, 2, 'fa-tv', '電視', 1, 118, '2025-01-22 07:52:30'),
(120, 1, 'fa-stopwatch', '穿戴式設備', 5, 0, '2025-01-22 07:26:22'),
(121, 2, 'fa-save', '儲存設備', 5, 1, '2025-01-22 07:31:32'),
(122, 3, 'fa-database', '固態硬碟 (SSD)', 1, 121, '2025-01-22 07:34:30'),
(123, 3, 'fa-hdd', '傳統硬碟 (HDD)', 2, 121, '2025-01-22 07:34:53'),
(124, 3, 'fa-server', '網路儲存設備 (NAS)', 3, 121, '2025-01-22 07:35:17'),
(125, 3, 'fa-usb', '外接硬碟', 4, 121, '2025-01-22 07:35:37'),
(126, 3, 'fa-memory', '記憶卡與隨身碟', 5, 121, '2025-01-22 07:35:59'),
(127, 2, 'fa-microchip', '電腦零組件', 6, 1, '2025-01-22 07:37:26'),
(128, 3, 'fa-microchip', '處理器 (CPU)', 1, 127, '2025-01-22 07:38:04'),
(129, 3, 'fa-video', '顯示卡 (GPU)', 2, 127, '2025-01-22 07:38:21'),
(130, 3, 'fa-memory', '記憶體 (RAM)', 3, 127, '2025-01-22 07:38:42'),
(131, 3, 'fa-hard-drive', '主機板', 4, 127, '2025-01-22 07:39:17'),
(132, 3, 'fa-power-off', '電源供應器', 5, 127, '2025-01-22 07:39:36'),
(134, 2, 'fa-fan', '散熱設備', 7, 1, '2025-01-22 07:43:16'),
(135, 3, 'fa-wind', 'CPU 散熱器', 1, 134, '2025-01-22 07:43:58'),
(136, 3, 'fa-fan', '系統風扇', 2, 134, '2025-01-22 07:44:20'),
(137, 3, 'fa-water', '一體式水冷', 3, 134, '2025-01-22 07:44:38'),
(138, 3, 'fa-tools', '散熱膏', 4, 134, '2025-01-22 07:45:02'),
(144, 2, 'fa-stopwatch', '智慧手錶', 1, 120, '2025-01-22 07:55:12'),
(145, 2, 'fa-heartbeat', '健康追蹤器', 2, 120, '2025-01-22 07:55:38'),
(146, 2, 'fa-glasses', '智慧眼鏡', 3, 120, '2025-01-22 07:56:49'),
(147, 2, 'fa-battery-half', '可穿戴配件', 4, 120, '2025-01-22 07:57:05');

-- --------------------------------------------------------

--
-- 資料表結構 `town`
--

CREATE TABLE `town` (
  `townNo` bigint(20) NOT NULL COMMENT '鄕鎮市編號',
  `Name` varchar(150) NOT NULL COMMENT '鄕鎮市名稱',
  `Post` varchar(10) NOT NULL COMMENT '郵遞區號',
  `State` smallint(6) NOT NULL COMMENT '狀態',
  `AutoNo` int(10) NOT NULL COMMENT '上層城市編號連結'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `town`
--

INSERT INTO `town` (`townNo`, `Name`, `Post`, `State`, `AutoNo`) VALUES
(1, '中正區', '100', 0, 1),
(2, '大同區', '103', 0, 1),
(3, '中山區', '104', 0, 1),
(4, '松山區', '105', 0, 1),
(5, '大安區', '106', 0, 1),
(6, '萬華區', '108', 0, 1),
(7, '信義區', '110', 0, 1),
(8, '士林區', '111', 0, 1),
(9, '北投區', '112', 0, 1),
(10, '內湖區', '114', 0, 1),
(11, '南港區', '115', 0, 1),
(12, '文山區', '116', 0, 1),
(13, '仁愛區', '200', 0, 2),
(14, '信義區', '201', 0, 2),
(15, '中正區', '202', 0, 2),
(16, '中山區', '203', 0, 2),
(17, '安樂區', '204', 0, 2),
(18, '暖暖區', '205', 0, 2),
(19, '七堵區', '206', 0, 2),
(20, '萬里區', '207', 0, 3),
(21, '金山區', '208', 0, 3),
(22, '板橋區', '220', 0, 3),
(23, '汐止區', '221', 0, 3),
(24, '深坑區', '222', 0, 3),
(25, '石碇區', '223', 0, 3),
(26, '瑞芳區', '224', 0, 3),
(27, '平溪區', '226', 0, 3),
(28, '雙溪區', '227', 0, 3),
(29, '貢寮區', '228', 0, 3),
(30, '新店區', '231', 0, 3),
(31, '坪林區', '232', 0, 3),
(32, '烏來區', '233', 0, 3),
(33, '永和區', '234', 0, 3),
(34, '中和區', '235', 0, 3),
(35, '土城區', '236', 0, 3),
(36, '三峽區', '237', 0, 3),
(37, '樹林區', '238', 0, 3),
(38, '鶯歌區', '239', 0, 3),
(39, '三重區', '241', 0, 3),
(40, '新莊區', '242', 0, 3),
(41, '泰山區', '243', 0, 3),
(42, '林口區', '244', 0, 3),
(43, '蘆洲區', '247', 0, 3),
(44, '五股區', '248', 0, 3),
(45, '八里區', '249', 0, 3),
(46, '淡水區', '251', 0, 3),
(47, '三芝區', '252', 0, 3),
(48, '石門區', '253', 0, 3),
(49, '宜蘭市', '260', 0, 4),
(50, '頭城鎮', '261', 0, 4),
(51, '礁溪鄉', '262', 0, 4),
(52, '壯圍鄉', '263', 0, 4),
(53, '員山鄉', '264', 0, 4),
(54, '羅東鎮', '265', 0, 4),
(55, '三星鄉', '266', 0, 4),
(56, '大同鄉', '267', 0, 4),
(57, '五結鄉', '268', 0, 4),
(58, '冬山鄉', '269', 0, 4),
(59, '蘇澳鎮', '270', 0, 4),
(60, '南澳鄉', '272', 0, 4),
(61, '釣魚台列嶼', '290', 0, 4),
(62, '新竹市(東區)', '300', 0, 5),
(63, '竹北市', '302', 0, 6),
(64, '湖口鄉', '303', 0, 6),
(65, '新豐鄉', '304', 0, 6),
(66, '新埔鎮', '305', 0, 6),
(67, '關西鎮', '306', 0, 6),
(68, '芎林鄉', '307', 0, 6),
(69, '寶山鄉', '308', 0, 6),
(70, '竹東鎮', '310', 0, 6),
(71, '五峰鄉', '311', 0, 6),
(72, '橫山鄉', '312', 0, 6),
(73, '尖石鄉', '313', 0, 6),
(74, '北埔鄉', '314', 0, 6),
(75, '峨眉鄉', '315', 0, 6),
(76, '中壢區', '320', 0, 7),
(77, '平鎮區', '324', 0, 7),
(78, '龍潭區', '325', 0, 7),
(79, '楊梅區', '326', 0, 7),
(80, '新屋區', '327', 0, 7),
(81, '觀音區', '328', 0, 7),
(82, '桃園區', '330', 0, 7),
(83, '龜山區', '333', 0, 7),
(84, '八德區', '334', 0, 7),
(85, '大溪區', '335', 0, 7),
(86, '復興區', '336', 0, 7),
(87, '大園區', '337', 0, 7),
(88, '蘆竹區', '338', 0, 7),
(89, '竹南鎮', '350', 0, 8),
(90, '頭份市', '351', 0, 8),
(91, '三灣鄉', '352', 0, 8),
(92, '南庄鄉', '353', 0, 8),
(93, '獅潭鄉', '354', 0, 8),
(94, '後龍鎮', '356', 0, 8),
(95, '通霄鎮', '357', 0, 8),
(96, '苑裡鎮', '358', 0, 8),
(97, '苗栗市', '360', 0, 8),
(98, '造橋鄉', '361', 0, 8),
(99, '頭屋鄉', '362', 0, 8),
(100, '公館鄉', '363', 0, 8),
(101, '大湖鄉', '364', 0, 8),
(102, '泰安鄉', '365', 0, 8),
(103, '銅鑼鄉', '366', 0, 8),
(104, '三義鄉', '367', 0, 8),
(105, '西湖鄉', '368', 0, 8),
(106, '卓蘭鎮', '369', 0, 8),
(107, '中區', '400', 0, 9),
(108, '東區', '401', 0, 9),
(109, '南區', '402', 0, 9),
(110, '西區', '403', 0, 9),
(111, '北區', '404', 0, 9),
(112, '北屯區', '406', 0, 9),
(113, '西屯區', '407', 0, 9),
(114, '南屯區', '408', 0, 9),
(115, '太平區', '411', 0, 9),
(116, '大里區', '412', 0, 9),
(117, '霧峰區', '413', 0, 9),
(118, '烏日區', '414', 0, 9),
(119, '豐原區', '420', 0, 9),
(120, '后里區', '421', 0, 9),
(121, '石岡區', '422', 0, 9),
(122, '東勢區', '423', 0, 9),
(123, '和平區', '424', 0, 9),
(124, '新社區', '426', 0, 9),
(125, '潭子區', '427', 0, 9),
(126, '大雅區', '428', 0, 9),
(127, '神岡區', '429', 0, 9),
(128, '大肚區', '432', 0, 9),
(129, '沙鹿區', '433', 0, 9),
(130, '龍井區', '434', 0, 9),
(131, '梧棲區', '435', 0, 9),
(132, '清水區', '436', 0, 9),
(133, '大甲區', '437', 0, 9),
(134, '外埔區', '438', 0, 9),
(135, '大安區', '439', 0, 9),
(136, '彰化市', '500', 0, 10),
(137, '芬園鄉', '502', 0, 10),
(138, '花壇鄉', '503', 0, 10),
(139, '秀水鄉', '504', 0, 10),
(140, '鹿港鎮', '505', 0, 10),
(141, '福興鄉', '506', 0, 10),
(142, '線西鄉', '507', 0, 10),
(143, '和美鎮', '508', 0, 10),
(144, '伸港鄉', '509', 0, 10),
(145, '員林市', '510', 0, 10),
(146, '社頭鄉', '511', 0, 10),
(147, '永靖鄉', '512', 0, 10),
(148, '埔心鄉', '513', 0, 10),
(149, '溪湖鎮', '514', 0, 10),
(150, '大村鄉', '515', 0, 10),
(151, '埔鹽鄉', '516', 0, 10),
(152, '田中鎮', '520', 0, 10),
(153, '北斗鎮', '521', 0, 10),
(154, '田尾鄉', '522', 0, 10),
(155, '埤頭鄉', '523', 0, 10),
(156, '溪州鄉', '524', 0, 10),
(157, '竹塘鄉', '525', 0, 10),
(158, '二林鎮', '526', 0, 10),
(159, '大城鄉', '527', 0, 10),
(160, '芳苑鄉', '528', 0, 10),
(161, '二水鄉', '530', 0, 10),
(162, '南投市', '540', 0, 11),
(163, '中寮鄉', '541', 0, 11),
(164, '草屯鎮', '542', 0, 11),
(165, '國姓鄉', '544', 0, 11),
(166, '埔里鎮', '545', 0, 11),
(167, '仁愛鄉', '546', 0, 11),
(168, '名間鄉', '551', 0, 11),
(169, '集集鎮', '552', 0, 11),
(170, '水里鄉', '553', 0, 11),
(171, '魚池鄉', '555', 0, 11),
(172, '信義鄉', '556', 0, 11),
(173, '竹山鎮', '557', 0, 11),
(174, '鹿谷鄉', '558', 0, 11),
(175, '斗南鎮', '630', 0, 12),
(176, '大埤鄉', '631', 0, 12),
(177, '虎尾鎮', '632', 0, 12),
(178, '土庫鎮', '633', 0, 12),
(179, '褒忠鄉', '634', 0, 12),
(180, '東勢鄉', '635', 0, 12),
(181, '臺西鄉', '636', 0, 12),
(182, '崙背鄉', '637', 0, 12),
(183, '麥寮鄉', '638', 0, 12),
(184, '斗六市', '640', 0, 12),
(185, '林內鄉', '643', 0, 12),
(186, '古坑鄉', '646', 0, 12),
(187, '莿桐鄉', '647', 0, 12),
(188, '西螺鎮', '648', 0, 12),
(189, '二崙鄉', '649', 0, 12),
(190, '北港鎮', '651', 0, 12),
(191, '水林鄉', '652', 0, 12),
(192, '口湖鄉', '653', 0, 12),
(193, '四湖鄉', '654', 0, 12),
(194, '元長鄉', '655', 0, 12),
(195, '嘉義市(東區)', '600', 0, 13),
(196, '番路鄉', '602', 0, 14),
(197, '梅山鄉', '603', 0, 14),
(198, '竹崎鄉', '604', 0, 14),
(199, '阿里山鄉', '605', 0, 14),
(200, '中埔鄉', '606', 0, 14),
(201, '大埔鄉', '607', 0, 14),
(202, '水上鄉', '608', 0, 14),
(203, '鹿草鄉', '611', 0, 14),
(204, '太保市', '612', 0, 14),
(205, '朴子市', '613', 0, 14),
(206, '東石鄉', '614', 0, 14),
(207, '六腳鄉', '615', 0, 14),
(208, '新港鄉', '616', 0, 14),
(209, '民雄鄉', '621', 0, 14),
(210, '大林鎮', '622', 0, 14),
(211, '溪口鄉', '623', 0, 14),
(212, '義竹鄉', '624', 0, 14),
(213, '布袋鎮', '625', 0, 14),
(214, '中西區', '700', 0, 15),
(215, '東區', '701', 0, 15),
(216, '南區', '702', 0, 15),
(217, '北區', '704', 0, 15),
(218, '安平區', '708', 0, 15),
(219, '安南區', '709', 0, 15),
(220, '永康區', '710', 0, 15),
(221, '歸仁區', '711', 0, 15),
(222, '新化區', '712', 0, 15),
(223, '左鎮區', '713', 0, 15),
(224, '玉井區', '714', 0, 15),
(225, '楠西區', '715', 0, 15),
(226, '南化區', '716', 0, 15),
(227, '仁德區', '717', 0, 15),
(228, '關廟區', '718', 0, 15),
(229, '龍崎區', '719', 0, 15),
(230, '官田區', '720', 0, 15),
(231, '麻豆區', '721', 0, 15),
(232, '佳里區', '722', 0, 15),
(233, '西港區', '723', 0, 15),
(234, '七股區', '724', 0, 15),
(235, '將軍區', '725', 0, 15),
(236, '學甲區', '726', 0, 15),
(237, '北門區', '727', 0, 15),
(238, '新營區', '730', 0, 15),
(239, '後壁區', '731', 0, 15),
(240, '白河區', '732', 0, 15),
(241, '東山區', '733', 0, 15),
(242, '六甲區', '734', 0, 15),
(243, '下營區', '735', 0, 15),
(244, '柳營區', '736', 0, 15),
(245, '鹽水區', '737', 0, 15),
(246, '善化區', '741', 0, 15),
(247, '大內區', '742', 0, 15),
(248, '山上區', '743', 0, 15),
(249, '新市區', '744', 0, 15),
(250, '安定區', '745', 0, 15),
(251, '新興區', '800', 0, 16),
(252, '前金區', '801', 0, 16),
(253, '苓雅區', '802', 0, 16),
(254, '鹽埕區', '803', 0, 16),
(255, '鼓山區', '804', 0, 16),
(256, '旗津區', '805', 0, 16),
(257, '前鎮區', '806', 0, 16),
(258, '三民區', '807', 0, 16),
(259, '楠梓區', '811', 0, 16),
(260, '小港區', '812', 0, 16),
(261, '左營區', '813', 0, 16),
(262, '仁武區', '814', 0, 16),
(263, '大社區', '815', 0, 16),
(264, '岡山區', '820', 0, 16),
(265, '路竹區', '821', 0, 16),
(266, '阿蓮區', '822', 0, 16),
(267, '田寮區', '823', 0, 16),
(268, '燕巢區', '824', 0, 16),
(269, '橋頭區', '825', 0, 16),
(270, '梓官區', '826', 0, 16),
(271, '彌陀區', '827', 0, 16),
(272, '永安區', '828', 0, 16),
(273, '湖內區', '829', 0, 16),
(274, '鳳山區', '830', 0, 16),
(275, '大寮區', '831', 0, 16),
(276, '林園區', '832', 0, 16),
(277, '鳥松區', '833', 0, 16),
(278, '大樹區', '840', 0, 16),
(279, '旗山區', '842', 0, 16),
(280, '美濃區', '843', 0, 16),
(281, '六龜區', '844', 0, 16),
(282, '內門區', '845', 0, 16),
(283, '杉林區', '846', 0, 16),
(284, '甲仙區', '847', 0, 16),
(285, '桃源區', '848', 0, 16),
(286, '那瑪夏區', '849', 0, 16),
(287, '茂林區', '851', 0, 16),
(288, '茄萣區', '852', 0, 16),
(289, '東沙', '817', 0, 17),
(290, '南沙', '819', 0, 17),
(291, '馬公市', '880', 0, 18),
(292, '西嶼鄉', '881', 0, 18),
(293, '望安鄉', '882', 0, 18),
(294, '七美鄉', '883', 0, 18),
(295, '白沙鄉', '884', 0, 18),
(296, '湖西鄉', '885', 0, 18),
(297, '屏東市', '900', 0, 19),
(298, '三地門鄉', '901', 0, 19),
(299, '霧臺鄉', '902', 0, 19),
(300, '瑪家鄉', '903', 0, 19),
(301, '九如鄉', '904', 0, 19),
(302, '里港鄉', '905', 0, 19),
(303, '高樹鄉', '906', 0, 19),
(304, '鹽埔鄉', '907', 0, 19),
(305, '長治鄉', '908', 0, 19),
(306, '麟洛鄉', '909', 0, 19),
(307, '竹田鄉', '911', 0, 19),
(308, '內埔鄉', '912', 0, 19),
(309, '萬丹鄉', '913', 0, 19),
(310, '潮州鎮', '920', 0, 19),
(311, '泰武鄉', '921', 0, 19),
(312, '來義鄉', '922', 0, 19),
(313, '萬巒鄉', '923', 0, 19),
(314, '崁頂鄉', '924', 0, 19),
(315, '新埤鄉', '925', 0, 19),
(316, '南州鄉', '926', 0, 19),
(317, '林邊鄉', '927', 0, 19),
(318, '東港鄉', '928', 0, 19),
(319, '琉球鄉', '929', 0, 19),
(320, '佳冬鄉', '931', 0, 19),
(321, '新園鄉', '932', 0, 19),
(322, '枋寮鄉', '940', 0, 19),
(323, '枋山鄉', '941', 0, 19),
(324, '春日鄉', '942', 0, 19),
(325, '獅子鄉', '943', 0, 19),
(326, '車城鄉', '944', 0, 19),
(327, '牡丹鄉', '945', 0, 19),
(328, '恆春鎮', '946', 0, 19),
(329, '滿州鄉', '947', 0, 19),
(330, '臺東市', '950', 0, 20),
(331, '綠島鄉', '951', 0, 20),
(332, '蘭嶼鄉', '952', 0, 20),
(333, '延平鄉', '953', 0, 20),
(334, '卑南鄉', '954', 0, 20),
(335, '鹿野鄉', '955', 0, 20),
(336, '關山鎮', '956', 0, 20),
(337, '海端鄉', '957', 0, 20),
(338, '池上鄉', '958', 0, 20),
(339, '東河鄉', '959', 0, 20),
(340, '成功鎮', '961', 0, 20),
(341, '長濱鄉', '962', 0, 20),
(342, '太麻里鄉', '963', 0, 20),
(343, '金峰鄉', '964', 0, 20),
(344, '大武鄉', '965', 0, 20),
(345, '達仁鄉', '966', 0, 20),
(346, '花蓮市', '970', 0, 21),
(347, '新城鄉', '971', 0, 21),
(348, '秀林鄉', '972', 0, 21),
(349, '吉安鄉', '973', 0, 21),
(350, '壽豐鄉', '974', 0, 21),
(351, '鳳林鎮', '975', 0, 21),
(352, '光復鄉', '976', 0, 21),
(353, '豐濱鄉', '977', 0, 21),
(354, '瑞穗鄉', '978', 0, 21),
(355, '萬榮鄉', '979', 0, 21),
(356, '玉里鎮', '981', 0, 21),
(357, '卓溪鄉', '982', 0, 21),
(358, '富里鄉', '983', 0, 21),
(359, '金沙鎮', '890', 0, 22),
(360, '金湖鎮', '891', 0, 22),
(361, '金寧鄉', '892', 0, 22),
(362, '金城鎮', '893', 0, 22),
(363, '烈嶼鄉', '894', 0, 22),
(364, '烏坵鄉', '896', 0, 22),
(365, '南竿鄉', '209', 0, 23),
(366, '北竿鄉', '210', 0, 23),
(367, '莒光鄉', '211', 0, 23),
(368, '東引鄉', '212', 0, 23),
(371, '新竹市(北區)', '300', 0, 5),
(372, '新竹市(香山區)', '300', 0, 5),
(373, '嘉義市(西區)', '600', 0, 13);

-- --------------------------------------------------------

--
-- 資料表結構 `uorder`
--

CREATE TABLE `uorder` (
  `orderid` varchar(30) NOT NULL COMMENT '訂單編號',
  `emailid` int(10) NOT NULL COMMENT '會員編號',
  `addressid` int(10) NOT NULL COMMENT '收件人編號',
  `howpay` tinyint(4) NOT NULL DEFAULT 1 COMMENT '如何付款',
  `paystatus` int(5) DEFAULT NULL COMMENT '付款狀態',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '訂單處理狀態',
  `remark` varchar(200) DEFAULT NULL COMMENT '備註',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '訂單時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- 傾印資料表的資料 `uorder`
--

INSERT INTO `uorder` (`orderid`, `emailid`, `addressid`, `howpay`, `paystatus`, `status`, `remark`, `create_date`) VALUES
('2025031002360960819', 11, 2, 3, 35, 7, NULL, '2025-03-10 06:36:09'),
('2025031002435368233', 11, 3, 3, 35, 7, NULL, '2025-03-10 06:43:53'),
('2025031004042052373', 11, 2, 3, 35, 7, NULL, '2025-03-10 08:04:20'),
('2025031109384386221', 2, 1, 3, 35, 7, NULL, '2025-03-11 01:38:43'),
('2025031109390634375', 2, 5, 3, 35, 7, NULL, '2025-03-11 01:39:06');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `addbook`
--
ALTER TABLE `addbook`
  ADD PRIMARY KEY (`addressid`);

--
-- 資料表索引 `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`caro_id`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- 資料表索引 `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`AutoNo`);

--
-- 資料表索引 `hot`
--
ALTER TABLE `hot`
  ADD PRIMARY KEY (`h_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`emailid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `multiselect`
--
ALTER TABLE `multiselect`
  ADD PRIMARY KEY (`msid`);

--
-- 資料表索引 `on_sale`
--
ALTER TABLE `on_sale`
  ADD PRIMARY KEY (`o_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`img_id`);

--
-- 資料表索引 `pyclass`
--
ALTER TABLE `pyclass`
  ADD PRIMARY KEY (`classid`);

--
-- 資料表索引 `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`townNo`);

--
-- 資料表索引 `uorder`
--
ALTER TABLE `uorder`
  ADD PRIMARY KEY (`orderid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `addbook`
--
ALTER TABLE `addbook`
  MODIFY `addressid` int(10) NOT NULL AUTO_INCREMENT COMMENT '地址ID', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `carousel`
--
ALTER TABLE `carousel`
  MODIFY `caro_id` int(3) NOT NULL AUTO_INCREMENT COMMENT '輪播編號', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(10) NOT NULL AUTO_INCREMENT COMMENT '購物車編號', AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `city`
--
ALTER TABLE `city`
  MODIFY `AutoNo` int(10) NOT NULL AUTO_INCREMENT COMMENT '城市編號', AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `hot`
--
ALTER TABLE `hot`
  MODIFY `h_id` int(3) NOT NULL AUTO_INCREMENT COMMENT '熱銷商品流水號', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `emailid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'email流水號', AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `multiselect`
--
ALTER TABLE `multiselect`
  MODIFY `msid` int(5) NOT NULL AUTO_INCREMENT COMMENT '多功能選擇ID', AUTO_INCREMENT=39;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `on_sale`
--
ALTER TABLE `on_sale`
  MODIFY `o_id` int(3) NOT NULL AUTO_INCREMENT COMMENT '特價商品流水號', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '產品編號', AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_img`
--
ALTER TABLE `product_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '圖檔編號', AUTO_INCREMENT=39;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pyclass`
--
ALTER TABLE `pyclass`
  MODIFY `classid` int(3) NOT NULL AUTO_INCREMENT COMMENT '產品類別', AUTO_INCREMENT=148;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `town`
--
ALTER TABLE `town`
  MODIFY `townNo` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '鄕鎮市編號', AUTO_INCREMENT=374;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
