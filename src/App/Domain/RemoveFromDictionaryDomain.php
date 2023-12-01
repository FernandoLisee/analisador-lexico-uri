<?php

namespace App\Domain;

use Slim\Http\Request;
use LexicalAnalyzer\Tokenizer;
use LexicalAnalyzer\Token;

/**
 * Description of RemoveFromDictionaryDomain
 *
 * @author gusta
 */
class RemoveFromDictionaryDomain extends AbstractDomain {

    public function __invoke(Request $request): array {

        $analyzer = $this->container->get("analyzer");

        $analyzer->removeWord(new Token($request->getParsedBodyParam("word")));

        $read = $analyzer->readInput(new Tokenizer($request->getParsedBodyParam("in")));
        
        $analyzer->saveState($this->container->get("storage"));

        return compact('read');
    }

}
