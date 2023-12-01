<?php

namespace App\Responder;

use Slim\Http\Response as Response;
use SlimAdr\AbstractContainerConstructor;

/**
 *
 * @author gusta
 */
abstract class AbstractResponder extends AbstractContainerConstructor {
    
    /**
     * 
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public abstract function __invoke(Response $response, array $data): Response;
}
