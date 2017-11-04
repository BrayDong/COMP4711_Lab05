<?php

if (! class_exists('PHPUnit_Framework_TestCase'))
{
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}


class TaskTest extends PHPUnit_Framework_TestCase {
//    private $CI;
//
    private $task;

    public function setUp() {
        // Load CI instance normally
//        $this->CI = &get_instance();
        $this->task = new Task();
    }


    public function testSetTaskValid() {

        $taskName = "A great task to test and Accomplish 33";
        $this->task->Task = $taskName;

        $this->assertEquals($taskName, $this->task->task);

        //id,task,priority,size,group,deadline,status,flag

    }

    public function testSetTaskInvalidCharacters() {

        $taskName = "A great task to test and Accomplish #33";
        $this->task->Task = $taskName;

        $this->assertNotEquals($taskName, $this->task->task);

    }

    public function testSetTaskInvalidLength() {
        $taskName = "1234567890123456789012345678901234567890123456789012345678901234567890";
        $this->task->Task = $taskName;

        $this->assertNotEquals($taskName, $this->task->task);

    }

    public function testSetPrirorityValid1(){
        $priority = "0";
        $this->task->Priority = $priority;

        $this->assertEquals($priority, $this->task->priority);
    }


    public function testSetPrirorityValid2(){
        $priority = "3";
        $this->task->Priority = $priority;

        $this->assertEquals($priority, $this->task->priority);
    }

    public function testSetPrirorityInvalid1(){
        $priority = "4";
        $this->task->Priority = $priority;

        $this->assertNotEquals($priority, $this->task->priority);
    }

    public function testSetPrirorityInvalid2(){
        $priority = "-1";
        $this->task->Priority = $priority;

        $this->assertNotEquals($priority, $this->task->priority);
    }

    public function testSetPrirorityInvalid3(){
        $priority = "a";
        $this->task->Priority = $priority;

        $this->assertNotEquals($priority, $this->task->priority);

    }

    public function testSetSizeValid1(){
        $size = "0";
        $this->task->Size = $size;

        $this->assertEquals($size, $this->task->size);
    }

    public function testSetSizeValid2(){
        $size = "3";
        $this->task->Size = $size;

        $this->assertEquals($size, $this->task->size);
    }

    public function testSetSizeInvalid1(){
        $size = "a";
        $this->task->Size = $size;

        $this->assertNotEquals($size, $this->task->size);
    }

    public function testSetSizeInvalid2(){
        $size = "-1";
        $this->task->Size = $size;

        $this->assertNotEquals($size, $this->task->size);
    }

    public function testSetSizeInvalid3(){
        $size = "4";
        $this->task->Size = $size;

        $this->assertNotEquals($size, $this->task->size);
    }

    public function testGroupSizeValid1(){
        $group = "0";
        $this->task->Group = $group;

        $this->assertEquals($group, $this->task->group);
    }

    public function testSetGroupValid2(){
        $group = "4";
        $this->task->Group = $group;

        $this->assertEquals($group, $this->task->group);
    }

    public function testSetGroupInvalid1(){
        $group = "a";
        $this->task->Group = $group;

        $this->assertNotEquals($group, $this->task->group);
    }

    public function testSetGroupInvalid2(){
        $group = "-1";
        $this->task->Group = $group;

        $this->assertNotEquals($group, $this->task->group);
    }

    public function testSetGroupInvalid3(){
        $group = "5";
        $this->task->Group = $group;

        $this->assertNotEquals($group, $this->task->group);
    }


}