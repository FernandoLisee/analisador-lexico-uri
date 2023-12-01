<?php

namespace App\Responder;

use Slim\Http\Response;

/**
 * Description of ListDictionaryResponder
 *
 * @author gusta
 */
class ListDictionaryResponder extends AbstractResponder {

    public function __invoke(Response $response, array $data): Response {
        
        return $this->container['view']->render($response, 'dictionary.twig', $data);
    }

}
