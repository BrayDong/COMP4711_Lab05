<?php
/**
 * Created by PhpStorm.
 * User: brayden
 * Date: 2017-10-14
 * Time: 10:47 PM
 *
 * @property Parsedown parsedown
 *
 */

class Helpme extends Application
{
    public function index() {
        $this->data['pagetitle'] = 'Help Wanted!';
        $stuff = file_get_contents('../data/jobs.md');




        // $htmlstuff = $this->parsedown->parse($stuff);

        //$this->data['content'] = $this->parser->parseString($htmlstuff,$parameters,true);


        //$mdstuff = $this->parser->parseString($stuff,$parameters,true);

        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render();
    }
}