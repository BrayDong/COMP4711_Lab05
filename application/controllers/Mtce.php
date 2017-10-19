<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mtce extends Application
{

    public function index()
    {
        $this->data['pagetitle'] = 'BrayDong TODO List Maintenance';
        $tasks = $this->tasks->all(); // get all the tasks

//        // convert the array of task objects into an array of associative objects
//        foreach ($tasks as $task)
//            $converted[] = (array) $task;

        // substitute the status name
        foreach ($tasks as $task)
            if (!empty($task->status))
                $task->status = $this->app->status($task->status);

        // build the task presentation output
        $result = '';   // start with an empty array
        foreach ($tasks as $task)
            $result .= $this->parser->parse('oneitem',(array)$task,true);

        // and then pass them on
        $this->data['display_tasks'] = $result;
        $this->data['pagebody'] = 'itemlist';
        $this->render();



    }
}
