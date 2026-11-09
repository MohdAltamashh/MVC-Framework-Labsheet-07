<?php
class StudentModel extends BaseModel{
 public function all():array{return $this->db->query('SELECT * FROM students ORDER BY id DESC')->fetchAll();}
 public function find(int $id):?array{$s=$this->db->prepare('SELECT * FROM students WHERE id=?');$s->execute([$id]);return $s->fetch()?:null;}
 public function create(array $d):int{$s=$this->db->prepare('INSERT INTO students(name,email,course) VALUES(?,?,?)');$s->execute([$d['name'],$d['email'],$d['course']]);return (int)$this->db->lastInsertId();}
 public function update(int $id,array $d):bool{$s=$this->db->prepare('UPDATE students SET name=?,email=?,course=? WHERE id=?');$s->execute([$d['name'],$d['email'],$d['course'],$id]);return $s->rowCount()>0;}
 public function delete(int $id):bool{$s=$this->db->prepare('DELETE FROM students WHERE id=?');$s->execute([$id]);return $s->rowCount()>0;}
}
