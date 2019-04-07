<?php

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;

/**
 * Class UsuarioService
 * @package AppBundle\Service
 */
class UsuarioService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getHappyMessage(){
        $messages = array(
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!'
        );

        return $messages[array_rand($messages)];

        //$this->logger->info($messages[array_rand($messages)]);
    }
}
