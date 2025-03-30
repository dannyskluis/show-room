<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', 1);

    session_set_cookie_params([
        'lifetime' => 7200,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['last_activity'] = time();
}
