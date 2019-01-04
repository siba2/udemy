<?php
/**
 * Created by PhpStorm.
 * User: sebastian
 * Date: 2018-12-19
 * Time: 12:45
 */

namespace App\Service;


use Psr\Log\LoggerInterface;

class Greeting {

    private $loggeer;
    private $message;

    public function __construct(LoggerInterface $loggeer, string $message) {
        $this->loggeer = $loggeer;
        $this->message = $message;
    }

    public function greet(string $name): string{
        $this->loggeer->info("Greeed $name");
        return "{$this->message} $name";
    }

}