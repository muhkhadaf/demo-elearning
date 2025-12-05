<?php
// Redirect root to public entrypoint, preserving query string
$qs = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '';
header('Location: public/index.php' . $qs);
exit;
?>