<?php
class AuthMiddleware{public static function handle(Request $request):void{ $key=$_SERVER['HTTP_X_API_KEY']??'';if(!hash_equals('lab-demo-key',$key))Response::json(['error'=>'Unauthorized. Send X-API-Key: lab-demo-key'],401);}}
