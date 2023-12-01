<?php

namespace App\Domain;

use Slim\Http\Request as Request;
use SlimAdr\AbstractContainerConstructor;

/**
 *
 * @author gusta
 */
abstract class AbstractDomain extends AbstractContainerConstructor {
    
    /**
     * 
     * @param Request $request
     * @return array
     */
    public abstract function __invoke(Request $request): array;
}
