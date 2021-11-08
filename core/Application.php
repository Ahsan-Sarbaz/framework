<?php

namespace Jin\Core;

use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Environment $twig;

    public function __construct($root)
    {
        self::$app = $this;
        self::$ROOT_DIR = $root;
        $dotenv = Dotenv::createImmutable($root);
        $dotenv->load();
        
        $this->request = new Request();
        $this->router = new Router($this->request);
        

        $loader = new FilesystemLoader('./../views');
        $this->twig = new Environment($loader, [
            'cache' => './../runtime/twigcache',
            'debug' => $_ENV["APP_DEBUG"]
        ]);

    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function get($url, $callback)
    {
        $this->router->get($url, $callback);
    }

    public function post($url, $callback)
    {
        $this->router->post($url, $callback);
    }

    public function view($view, array $params)
    {
        echo $this->twig->render("$view.twig", $params);
    }
}

?>