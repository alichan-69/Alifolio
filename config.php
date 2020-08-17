<?php
define('DSN', 'mysql:host=[mysqlホスト名];dbname=[権限ユーザー名]');
define('DB_USER', '[権限ユーザー名]');
define('DB_PASSWORD', '[パスワード]');

define('SITE_URL', 'http://alichan.php.xdomain.jp/portfolio_php/');
define('ADMIN_URL', SITE_URL.'[管理者ページurl]');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/portfolio_php/');
