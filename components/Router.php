<?php


class Router
{

    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include $routesPath;
    }

    private function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function  run(){
        //echo "Router run!"."<br>";

        $uri = $this->getURI();

        //echo "URI is:  ".$uri.'<br>';

        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $uri)){

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)){
                    include_once $controllerFile;
                }

                //echo $controllerName.'<br>';
                //echo $actionName.'<br>';

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null){
                    break;
                }


            }
        }


    }

}