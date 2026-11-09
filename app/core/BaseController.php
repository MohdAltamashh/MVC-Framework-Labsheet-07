<?php
class BaseController{protected function json(array $data,int $status=200):never{Response::json($data,$status);}}
