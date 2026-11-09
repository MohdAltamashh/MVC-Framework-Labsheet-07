<?php
class StudentApiController extends BaseController{
 public function index(Request $r,array $p):never{$this->json(['data'=>(new StudentModel())->all()]);}
 public function show(Request $r,array $p):never{$s=(new StudentModel())->find((int)$p['id']);if(!$s)$this->json(['error'=>'Student not found'],404);$this->json(['data'=>$s]);}
 public function store(Request $r,array $p):never{$d=$r->input();if(empty($d['name'])||!filter_var($d['email']??'',FILTER_VALIDATE_EMAIL)||empty($d['course']))$this->json(['error'=>'Valid name, email and course are required'],422);$id=(new StudentModel())->create($d);$this->json(['message'=>'Student created','id'=>$id],201);}
 public function update(Request $r,array $p):never{$d=$r->input();if(empty($d['name'])||!filter_var($d['email']??'',FILTER_VALIDATE_EMAIL)||empty($d['course']))$this->json(['error'=>'Valid name, email and course are required'],422);$ok=(new StudentModel())->update((int)$p['id'],$d);$this->json(['message'=>$ok?'Student updated':'No row updated']);}
 public function destroy(Request $r,array $p):never{$ok=(new StudentModel())->delete((int)$p['id']);if(!$ok)$this->json(['error'=>'Student not found'],404);$this->json(['message'=>'Student deleted']);}
}
