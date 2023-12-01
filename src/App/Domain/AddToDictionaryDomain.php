<?php

namespace App\Domain;

use Slim\Http\Request;
use LexicalAnalyzer\Tokenizer;

/**
 * Description of AddToDictionaryDomain
 *
 * @author gusta
 */
class AddToDictionaryDomain extends AbstractDomain {

    
    public function __invoke(Request $request): array {
        
        $analyzer = $this->container->get("analyzer");
        
        $body = $request->getParsedBody();
        
        $tokenizer = new Tokenizer($body["in"]);
        
        $analyzer->addWord($tokenizer->end());
        
        $read = $analyzer->readInput($tokenizer);
        
        $analyzer->saveState($this->container->get("storage"));
        
        return compact('read');
    }

}
