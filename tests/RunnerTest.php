<?php
/**
 * Created by PhpStorm.
 * User: tebazil
 * Date: 09.08.15
 * Time: 15:56
 */

namespace tests;


use Yii;
use yii\httpclient\Client;

class RunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testMock()
    {
        $client = $this->getMock(Client::class);
        $this->assertInstanceOf(Client::class, $client);
    }
    public function testConfigNonexistentPath() {
        $this->setExpectedException('InvalidArgumentException');
        new ConsoleCommandRunner('asdfsdfsadf');
    }
}