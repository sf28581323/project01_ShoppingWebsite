# 電子商務購物網站

這是一個功能完整的電子商務購物網站，提供用戶瀏覽商品、加入購物車、結帳訂購等功能。

## 專案概述

本專案是一個基於PHP和MySQL的電子商務平台，具有現代化的UI設計和完整的購物流程。網站提供了會員系統、商品分類瀏覽、購物車管理、訂單處理等功能，適合作為中小型電商平台使用。

## 功能特色

- **會員系統**：註冊、登入、個人資料管理
- **商品瀏覽**：分類瀏覽、搜尋功能、商品詳情頁
- **購物車**：加入商品、修改數量、移除商品
- **結帳流程**：訂單確認、地址選擇、訂單提交
- **個人中心**：訂單歷史、個人資料修改、密碼變更
- **限時特價**：特價商品展示與倒計時功能
- **熱門商品**：展示熱門銷售商品

## 技術架構

- **前端**：HTML, CSS, JavaScript, jQuery, Bootstrap 5
- **後端**：PHP
- **資料庫**：MySQL
- **其他工具**：
  - jQuery Validate (表單驗證)
  - FancyBox (圖片展示)
  - Font Awesome (圖標)

## 目錄結構

- **Connections/**: 資料庫連接設定
- **images/**: 網站介面圖片
- **product_img/**: 商品圖片
- **uploads/**: 用戶上傳文件
- **fancybox-2.1.7/**: FancyBox圖片展示插件

## 主要文件

- **index.php**: 網站首頁
- **login.php**: 用戶登入頁面
- **register.php**: 用戶註冊頁面
- **profile.php**: 用戶個人資料頁面
- **cart.php**: 購物車頁面
- **checkout.php**: 結帳頁面
- **product_list.php**: 商品列表頁面
- **goods.php**: 商品詳情頁面
- **orderlist.php**: 訂單列表頁面
- **website_p01.css**: 主要樣式表
- **commlib.js**: 通用JavaScript函數
- **php_lib.php**: PHP通用函數庫

## 資料庫結構

資料庫名稱：`expstore`，主要表格包括：

- **member**: 會員資料
- **product**: 商品資訊
- **product_img**: 商品圖片
- **pyclass**: 商品分類
- **cart**: 購物車
- **uorder**: 訂單資訊
- **addbook**: 地址簿
- **on_sale**: 特價商品
- **hot**: 熱門商品
- **carousel**: 輪播圖設定

## 安裝指南

1. 將所有文件上傳到Web伺服器
2. 匯入 `expstore.sql` 到MySQL資料庫
3. 修改 `Connections/conn_db.php` 中的資料庫連接設定
4. 確保 `uploads/` 和 `product_img/` 目錄有寫入權限

## 使用須知

- 本網站需要PHP 7.0以上版本
- 需要MySQL 5.6以上版本
- 建議使用現代瀏覽器訪問以獲得最佳體驗
