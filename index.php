<?php
class Developer{
    const MAX_TASKS = 10;
    
    public $user_name; 
    public $tasks_array = array();
    
    public function add_task($name_task){
      if($this->can_add_task()){              
          $this->tasks_array[] = $name_task;      
          echo "<div>" . $this->user_name . " додано завдання '" . $name_task ."'. Всього завдань - " . count($this->tasks_array) . "</div>";
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
            echo "<div>Користувач: " . $this->user_name . ", завдання:" . array_shift($this->tasks_array) . ", залишилося - " . count($this->tasks_array) . "</div>";           
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
$dev->add_task('test1');
$dev->add_task('test2');

$dev->tasks();
$dev->work();
$dev->status();

class JuniorDeveloper extends Developer{
    const MAX_TASKS = 5;
    
    public function add_task($name_task){
        if(strlen($name_task)>20){
            echo "<div>Дуже важко</div>";
            return;
        }  
       parent::add_task($name_task); 
                     
    }
    public function __construct($name){
        parent::__construct($name);
    }
}
$dev_jun1 = new JuniorDeveloper('Junior1');
$dev_jun1->add_task('test3');
$dev_jun1->add_task('test test test test test test test test');

$dev_jun2 = new JuniorDeveloper('Junior2');
$dev_jun2->add_task('test4');

class SeniorDeveloper extends Developer{
    const MAX_TASKS = 15;
    public function work(){
        if(count($this->tasks_array) >= 2){
            $working_tasks = array_rand($this->tasks_array,2);
            unset($this->tasks_array[$working_tasks[0]]);
            echo "<div>Користувач: " . $this->user_name . ", завдання:"  . ", залишилося - " . count($this->tasks_array) . "</div>";    
            unset($this->tasks_array[$working_tasks[1]]);
            echo "<div>Користувач: " . $this->user_name . ", завдання:"  . ", залишилося - " . count($this->tasks_array) . "</div>";        
        }else{
            echo '<div>Лінь щось робити</div>';
        } 
    }
     public function __construct($name){
        parent::__construct($name);
    }
}
$dev_sen = new SeniorDeveloper('Senior');
$dev_sen->add_task('test5');
$dev_sen->add_task('test6');
$dev_sen->add_task('test7');
$dev_sen->add_task('test8');
$dev_sen->add_task('test9');
$dev_sen->add_task('test10');
$dev_sen->work();
$dev_sen->tasks();

/**************************************/

class Team{
    public $teams = array('seniors' => array('Олег' => array(),
                                             'Оксана' => array()),
                         'developers' => array('Олеся' => array(),
                                               'Василь' => array(),
                                               'Ольга' => array()),
                         'juniors' => array('Владислава' => array(),
                                        'Аркадій' => array(),
                                        'Ігор' => array()));
                                        
    public $priority = array('juniors','developers','seniors');
    
    public function add_task($name_task, $complexity = null, $to = null){
        if($complexity !== null && $to !== null){
            $this->teams[$complexity][$to][] = $name_task;
        }elseif($complexity !== null && $to === null){
            $min = array_keys($this->teams[$complexity],min($this->teams[$complexity]));
            $this->teams[$complexity][$min[0]][] = $name_task;
        }else{
            for($i=0;$i<count($this->priority);$i++){
                $min[$i] = array_keys($this->teams[$this->priority[$i]],min($this->teams[$this->priority[$i]]));               
            }            
             if(count($this->teams[$this->priority[0]][$min[0][0]]) <= count($this->teams[$this->priority[1]][$min[1][0]]) && 
                count($this->teams[$this->priority[0]][$min[0][0]]) <= count($this->teams[$this->priority[2]][$min[2][0]])){             
                $this->teams[$this->priority[0]][$min[0][0]][] = $name_task;
             }elseif(count($this->teams[$this->priority[1]][$min[1][0]]) <= count($this->teams[$this->priority[2]][$min[2][0]]) && 
                count($this->teams[$this->priority[1]][$min[1][0]]) < count($this->teams[$this->priority[0]][$min[0][0]])){
                $this->teams[$this->priority[1]][$min[1][0]][] = $name_task;
             }else{
                $this->teams[$this->priority[2]][$min[2][0]][] = $name_task;
             }                
        }
    }
    public function report(){
        for($i=0;$i<count($this->priority);$i++){
            echo "<b>" . $this->priority[$i] . "</b><br>";
                foreach($this->teams[$this->priority[$i]] as $key => $users){
                    echo "Користувач: " . $key . "<br>";
                    echo "<ul>";
                        foreach($users as $user){
                            echo "<li>" . $user . "</li>";
                        }
                    echo "</ul>";            
                }
        }         
    }
    public function seniors(){
        echo "<b>" . $this->priority[2] . "</b><br>";
        echo "<ul>";
            foreach($this->teams[$this->priority[2]] as $key => $seniors){
                echo "<li>" . $key . "</li>";
            }
        echo "</ul>";   
    }
    public function developers(){
         echo "<b>" . $this->priority[1] . "</b><br>";
         echo "<ul>";
            foreach($this->teams[$this->priority[1]] as $key => $developers){
                echo "<li>" . $key . "</li>";                           
            }
         echo "</ul>";   
    }
    public function juniors(){
        echo "<b>" . $this->priority[0] . "</b><br>";
        echo "<ul>";
            foreach($this->teams[$this->priority[0]] as $key => $juniors){
                echo "<li>" . $key . "</li>";                         
            }
        echo "</ul>";
    }
}
$team = new Team();
$team->add_task("task1","juniors");
$team->add_task("task2","juniors");
$team->add_task("task3","juniors","Аркадій");
$team->add_task("task4","juniors");
$team->add_task("task5","juniors");
$team->add_task("task6","seniors");
$team->add_task("task7","seniors","Оксана");
$team->add_task("task8","seniors","Оксана");
$team->add_task("task9");
$team->add_task("task10");
$team->add_task("task11");
$team->add_task("task11");
$team->add_task("task12");
$team->add_task("task13","juniors","Аркадій");
$team->add_task("task14");
$team->add_task("task15");
$team->add_task("task16");
$team->add_task("task17","developers");
$team->add_task("task18","developers");
$team->add_task("task19","developers","Олеся");
$team->add_task("task20","developers","Олеся");
$team->seniors();
$team->developers();
$team->juniors();
$team->report();
?>