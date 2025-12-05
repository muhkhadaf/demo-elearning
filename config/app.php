<?php
declare(strict_types=1);
session_start();
define('BASE_PATH', dirname(__DIR__));
define('UPLOADS_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads');
if (!is_dir(UPLOADS_PATH)) { mkdir(UPLOADS_PATH, 0777, true); }
if (!is_dir(UPLOADS_PATH . DIRECTORY_SEPARATOR . 'materials')) { mkdir(UPLOADS_PATH . DIRECTORY_SEPARATOR . 'materials', 0777, true); }
if (!is_dir(UPLOADS_PATH . DIRECTORY_SEPARATOR . 'submissions')) { mkdir(UPLOADS_PATH . DIRECTORY_SEPARATOR . 'submissions', 0777, true); }
define('DB_HOST', 'localhost');
define('DB_NAME', 'siakad_mdt');
define('DB_USER', 'root');
define('DB_PASS', '');
?>