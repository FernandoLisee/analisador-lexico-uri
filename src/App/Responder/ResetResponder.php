<?php

namespace App\Responder;

use Slim\Http\Response;

/**
 * Description of ResetResponder
 *
 * @author gusta
 */
class ResetResponder extends AbstractResponder {

    /**
     * 
     * @param Response $response
     * @param array $data
     */
    public function __invoke(Response $response, array $data): Response {
        
        return $response->withJson($data);
    }

}
