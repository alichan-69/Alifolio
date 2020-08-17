<?php
define('DSN', 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=alichan_question');
define('DB_USER', 'alichan_dbuser');
define('DB_PASSWORD', 'Murao0905');

define('SITE_URL', 'http://alichan.php.xdomain.jp/portfolio_php/');
define('ADMIN_URL', SITE_URL.'admin/');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/portfolio_php/');