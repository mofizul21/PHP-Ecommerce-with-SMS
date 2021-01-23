<?php

if (!function_exists('view')) {
    function view($view = 'index', $data = [])
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}

if (!function_exists('partial_view')) {
    function partial_view($view = 'index')
    {
        require_once __DIR__ . '/../views/partials/' . $view . '.php';
    }
}

if (!function_exists('site_url')) {
    function site_url()
    {
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        //$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
        //echo $protocol . '://' . $hostName . $pathInfo['dirname'] . "";
        echo 'https://' . $hostName . $pathInfo['dirname'] . "";
    }
}

if (!function_exists('errMsg')) {
    function errMsg($msg, $redirectLink)
    {
        $errors[] = $msg;
        $_SESSION['errors'] = $errors;
        header("Location: /{$redirectLink}");
        exit();
    }
}

if (!function_exists('successMsg')) {
    function successMsg($msg, $redirectLink)
    {
        $_SESSION['success'] = $msg;
        header("Location: /{$redirectLink}");
        exit;
    }
}

if (!function_exists('dd')) {
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
}
