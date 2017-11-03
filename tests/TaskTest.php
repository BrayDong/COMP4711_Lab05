<?php

if (! class_exists('PHPUnit_Framework_TestCase'))
{
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}


class CITest extends PHPUnit_Framework_TestCase {
    private $CI;

    public function setUp() {
        // Load CI instance normally
        $this->CI = &get_instance();
    }

    public function testGetPost() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['foo'] = 'bar';
        $this->assertEquals('bar', $this->CI->input->get_post('foo'));
    }


}