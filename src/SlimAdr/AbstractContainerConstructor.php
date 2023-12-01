<?php

namespace SlimAdr;

use Psr\Container\ContainerInterface;

/**
 * Description of ContainerConstructorInterface
 *
 * @author gusta
 */
abstract class AbstractContainerConstructor {
    
    /**
     *
     * @var ContainerInterface
     */
    public $container;
    
    public function __construct(ContainerInterface $container) {
        
        $this->container = $container;
    }
}
