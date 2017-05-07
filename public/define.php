<?php                              
define('PUBLIC_PATH', realpath(dirname(__DIR__) . '/public'));
define('VENDOR_PATH', realpath(dirname(dirname(__DIR__)) . '/vendor'));
define('TEMP_PATH', PUBLIC_PATH . '/tmp');
define('FILES_PATH', PUBLIC_PATH . '/files');
define('SCRIPTS_PATH',PUBLIC_PATH . '/scripts');
define('CAPTCHA_PATH',PUBLIC_PATH . '/captcha');
//Duong dan den thu muc /templates
define('TEMPLATE_PATH', PUBLIC_PATH . '/templates');
define('DATA_PATH', realpath(dirname(dirname(__FILE__))) . '/data');
define('SEARCH_PATH', DATA_PATH . '/data/search');
define('CACHE_PATH', DATA_PATH . '/data/cache');
// Cấu hình FTP
define("FTP_PATH", "/htdocs/resources/dev");
define("FTP_SERVER", "203.162.53.102");
define("FTP_USER", "idata");
define("FTP_PASS", "qutsnXhugR");
define("SERVER_IMG", "http://i.hdonline.vn/resources/new");
define("SERVER_IMG2", "http://i.hdonline.vn/resources/");
define("NO_IMG", "http://i.hdonline.vn/");
define("SERVER_ID", "http://localhost/id/public");
define("DOMAIN", "http://localhost");
define("APPLICATION_KEY", "test");
define("IDGUEST", "1");
define("IDMEMBER", "2");
define("IDMOVIE", "1");
define("IDAUDIOTM", "6");
define("CDN", "http://localhost/hdonline/public");
define("MEMCACHE_SERVER","127.0.0.1");
define("MEMCACHE_PORT",11211);
define("KEY_API", "dUWmorBSmX9dxYx5tynbsCsmxYxjJEchhjSCchhqfvJsKQJNchhjJEnbsCsmxYxjJEOxajSCchhjJEBSmjSCOxaFw6chhDfzsgdd4hZPAZPA");

// Region
define('NATION', 1, true);
define('PROVINCE', '', true);
define('DISTRICT', '', true);
define('WARD', '', true);
define('CATEGORY', '', true);
define('CATEGORY_TYPE', '', true);