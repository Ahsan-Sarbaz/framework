<?php

namespace Jin\Core;

abstract class Controller
{
    protected function view($view, $params)
    {
        return Application::$app->view($view, $params);
    }

}

?>