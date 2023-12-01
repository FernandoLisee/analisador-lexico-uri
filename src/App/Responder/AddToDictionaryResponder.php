<?php

namespace App\Responder;

use Slim\Http\Response;

/**
 * Description of AddToDictionaryResponder
 *
 * @author gusta
 */
class AddToDictionaryResponder extends AbstractResponder {

    use \LexicalAnalyzer\LexicalAnalyzerResponderTrait;
    
    public function __invoke(Response $response, array $data): Response {

        $data["read"] = array_map([$this, 'formatReadResponse'], $data["read"]);

        return $response->withJson($data);
    }

}
