<?php
class Developer{
    const MAX_TASKS = 10;
    
    public $user_name; 
    public $tasks_array = array();
    
    public function add_task($name_task){
      if($this->can_add_task()){              
          $this->tasks_array[] = $name_task;      
          echo $this->user_name . " додано завдання '" . $name_task ."'. Всього завдань - " . count($this->tasks_array);
      }else{
          echo "Занадто багато завдань";
      }  
    }
    public function tasks(){
        foreach($this->tasks_array as $k=>$v){
            echo $k . ". " . $v ."<br>";
        }
    }
    public function status(){
        if(count($this->tasks_array) == 0){
            echo 'Вільний';
        }elseif($this->can_work()){
            echo 'Працює';
        }else{
            echo 'Зайнятий';
        }
    }
    public function work(){        
        if($this->can_add_task()){ 
            echo "Користувач: " . $this->user_name . ", завдання:" . array_shift($this->tasks_array) . ", залишилося - " . count($this->tasks_array);           
        }else{
            return 'Роботи немає';
        }        
    }
    public function can_add_task(){
        if(count($this->tasks_array)<self::MAX_TASKS){
            return true;
        }else{
            return false;
        }
    }
    public function can_work(){
        if(count($this->tasks_array) < self::MAX_TASKS && count($this->tasks_array) > 0){
            return true;
        }else{
            return false;
        }
    }
    public function __construct($name){
        $this->user_name = $name;
    }
}

$dev = new Developer('Petro');
$dev->add_task('test');
$dev->add_task('test2');

$dev->tasks();
$dev->work();
$dev->status();

class JuniorDeveloper extends Developer{
    const MAX_TASKS = 5;
    public function add_task($name_task){
       parent::add_task($name_task); 
       if(strlen($name_task)>20){
            echo "Дуже важко";
            return;
        }                
    }
    public function __construct($name){
        parent::__construct($name);
    }
}
$d = new JuniorDeveloper('Jun');
$d->add_task('test');
$d->add_task('test123435346576560 dfdfdfhdfhdfhdfhdfhd 6346y34y3e');

$d = new JuniorDeveloper('Jun345');
$d->add_task('testreg');

class SeniorDeveloper extends Developer{
    const MAX_TASKS = 15;
    public function work(){
        if($this->can_add_task()){ 
            echo "Користувач: " . $this->user_name . ", завдання:" . array_shift($this->tasks_array) . ", залишилося - " . count($this->tasks_array);           
        }else{
            return 'Роботи немає';
        } 
    }
     public function __construct($name){
        parent::__construct($name);
    }
}
$d = new SeniorDeveloper('senjor');
$d->add_task('testreg');
/*
class Team{
    public function add_task($complexity = null, $to = null){
        
    }
    public function report(){
        
    }
    public function seniors(){
        
    }
    public function developers(){
        
    }
    public function juniors(){
        
    }
}*/
?>