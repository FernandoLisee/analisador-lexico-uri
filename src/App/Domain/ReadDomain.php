<?php

namespace App\Domain;

use Slim\Http\Request;
use LexicalAnalyzer\Tokenizer;

/**
 * Description of ReadDomain
 *
 * @author gusta
 */
class ReadDomain extends AbstractDomain {

    /**
     * 
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array {

        $body = $request->getParsedBody();
        
        $tokenizer = new Tokenizer($body["in"]);

        $analyzer = $this->container->get("analyzer");

        $read = $analyzer->readInput($tokenizer);
        
        $analyzer->saveState($this->container->get("storage"));

        return compact('read');
    }

}
