<?php

namespace App\Responder;

use Slim\Http\Response;

/**
 * Description of ActualStateResponder
 *
 * @author gusta
 */
class ActualStateResponder extends AbstractResponder {
    
    public function __invoke(Response $response, array $data): Response {
        
        return $this->container->get("view")->render($response, 'automaton.twig', $data);
    }

}
