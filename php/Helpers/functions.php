<?php

require_once __DIR__ . '/../App/Services/Service.php'; 

function loadView($view, $data = [])
{
   App\Services\Service::loadView($view, $data);
}

function dd(...$data )
{
    echo "<pre>";
    foreach ($data as $d) {
        var_dump($d);
    }

    echo "</pre>";
    die();
}