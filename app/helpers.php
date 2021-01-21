<?php

if (!function_exists('view')) {
    function view($view = 'index')
    {
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
        return "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
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
