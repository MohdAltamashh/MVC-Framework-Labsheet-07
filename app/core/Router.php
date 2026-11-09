<?php
class Router{
 private array $routes=[];public function get(string $p,array $h):void{$this->add('GET',$p,$h);}public function post(string $p,array $h):void{$this->add('POST',$p,$h);}public function put(string $p,array $h):void{$this->add('PUT',$p,$h);}public function delete(string $p,array $h):void{$this->add('DELETE',$p,$h);}
 private function add(string $m,string $p,array $h):void{$this->routes[]=[$m,$p,$h];}
 public function dispatch(Request $r):void{foreach($this->routes as [$m,$p,$h]){$pattern=preg_replace('#\{([a-zA-Z_]+)\}#','(?P<$1>[^/]+)',$p);if($m===$r->method()&&preg_match('#^'.$pattern.'$#',$r->path(),$matches)){$params=array_filter($matches,'is_string',ARRAY_FILTER_USE_KEY);[$class,$method]=$h;(new $class())->$method($r,$params);return;}}Response::json(['error'=>'Route not found'],404);}
}
