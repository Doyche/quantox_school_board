<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp;

/**
 * Class Route
 * @package MyApp
 */
class Route
{
    private static $routes = Array();

    public static function add($path, $function, $method  = ['get']){
        array_push(self::$routes, Array(
            'path' => $path,
            'function' => $function,
            'method' => $method
        ));
    }

    public static function run($basepath = '/'){
        $url = parse_url($_SERVER['REQUEST_URI']);
        if(isset($url['path']) and $url['path'] != '/'){
            $path = rtrim($url['path'], '/');
        }else{
            $path = '/';
        }

        $status = false;
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        foreach (self::$routes as $route){
            if($basepath != '' and $basepath != '/'){
                $route['path'] = '('.$basepath.')'.$route['path'];
            }
            $route['path'] = '#^'.$route['path'].'$#i';
            if(preg_match($route['path'], $path, $matches)){
                array_shift($matches);
                if ($basepath != '' && $basepath != '/') {
                    array_shift($matches);
                }
                $input_arguments = $matches;
                foreach ((array)$route['method'] as $allowedMethod) {
                    if($method == strtolower($allowedMethod)){
                        call_user_func_array($route['function'], $input_arguments);
                        $status = true;
                        break;
                    }
                }
            }

            if($status){
                break;
            }
        }

        if($status === false){
            self::notfoundurl();
        }
    }

    public static function notfoundurl(){
        http_response_code(404);
        include_once 'error404.html';
    }

}
