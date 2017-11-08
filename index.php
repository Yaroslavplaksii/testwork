<?php
class Developer{
    const MAX_TASKS = 10;
    
    public static $user_name;
    
    public function add_task(){
        
    }
    public function tasks(){
        
    }
    public function status(){
        
    }
    public function work(){
        
    }
    public function can_add_task(){
        
    }
    public function can_work(){
        
    }
    public function __construct($name){
        self::$user_name = $name;
    }
}
class JuniorDeveloper extends Developer{
    const MAX_TASKS = 5;
    
}
class SeniorDeveloper extends Developer{
    const MAX_TASKS = 15;
    
}

?>