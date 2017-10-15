<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

	    $tasks = $this->tasks->all();

	    $count = 0;
	    foreach(array_reverse($tasks) AS $task) {

            $task->priority = $this->app->priority($task->priority);
            $display_tasks[] = (array) $task;
	        if ($task->status != 2)
	            $count++;
            if ($count >= 5) break;

        }

        $count = 0;
        foreach($tasks AS $task) {
            if ($task->status != 2)
                $count++;
        }

		$this->data['pagebody'] = 'homepage';
		$this->data['remaining_tasks'] = $count;
		$this->data['display_tasks'] = $display_tasks;
		$this->render(); 
	}

}
