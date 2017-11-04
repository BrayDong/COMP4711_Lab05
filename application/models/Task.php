<?php
/**
 * Created by PhpStorm.
 * User: kimdongwon
 * Date: 2017-11-03
 * Time: 4:31 PM
 */
//require_once APPPATH.'Model/Entity.php';

require_once APPPATH . 'core/Entity.php';

class Task extends Entity{

    protected $task;
    protected $priority;
    protected $size;
    protected $group;

    public function setTask($value){

//        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
//        if($value != $alNum) return;

        if(preg_match('/[^0-9a-zA-Z ]/', $value)
        || strlen($value) > 64)
            return;

        $this -> task = $value;
    }

    public function setPriority($value){

        if(!preg_match('/[^0-9]/si', $value)
            && ($value < 4 && $value >= 0))
            $this -> priority = $value;
    }

    public function setSize($value){

        if(!preg_match('/[^0-9]/si', $value) &&
            ($value < 4 && $value >= 0))
        $this -> size = $value;
    }

    public function setGroup($value){

        if(!preg_match('/[^0-9]/si', $value) &&
            ($value < 5 && $value >= 0))
        $this -> group = $value;
    }
}