<?php
/**
 * Created by PhpStorm.
 * User: kimdongwon
 * Date: 2017-10-12
 * Time: 1:50 PM
 */

class Tasks extends CSV_Model{

    public function __construct()
    {
        parent::__construct(APPPATH . '../data/tasks.csv', 'id');
    }
}