<?php

function site_url()
{
    return "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}

function errMsg($msg, $redirectLink)
{
    $errors[] = $msg;
    $_SESSION['errors'] = $errors;
    header("Location: /{$redirectLink}");
    return;
}
