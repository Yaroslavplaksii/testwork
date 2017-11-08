<?php
class Developer{
    const MAX_TASKS = 10;
    
    public static $user_name;
    public static $user_status = 0;
    public static $user_tasks = 0;
    
    public function add_task($name_task){
      if($this->can_add_task()){
          self::$user_tasks++;            
      }  
    }
    public function tasks(){
        
    }
    public function status(){
        if(self::$user_status == 0){
            return 'Вільний';
        }elseif(self::$user_status == 1){
            return 'Працюю';
        }else{
            return 'Зайнятий';
        }
    }
    public function work(){        
        if(self::$user_tasks>0){
            self::$user_tasks--;
            self::$user_status = 1;
            //return  self::$user_name." ".$name_task   ;
        }else{
            return 'Роботи немає';
        }        
    }
    public function can_add_task(){
        if(self::$user_tasks<self::MAX_TASKS){
            return true;
        }else{
            return false;
        }
    }
    public function can_work(){
        if(self::$user_status == 0){
            return true;
        }else{
            return false;
        }
    }
    public function __construct($name){
        self::$user_name = $name;
    }
}
class JuniorDeveloper extends Developer{
    const MAX_TASKS = 5;
    public function add_task(){
        
    }
}
class SeniorDeveloper extends Developer{
    const MAX_TASKS = 15;
    public function work(){
        
    }
}

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
}
?>