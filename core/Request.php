<?php

namespace Jin\Core;

class Request
{
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function url()
    {
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        if($position !== false)
        {
            $url = substr($url, 0, $position);
        }

        return $url;
    }

    public function isGET() : bool
    {
        return $this->method() === "get";
    }

    public function isPOST() : bool
    {
        return $this->method() === "post";
    }

    public function body()
    {
        $data = [];

        if($this->isGET())
        {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }else if($this->isPOST())
        {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $data;
    }



};


?>