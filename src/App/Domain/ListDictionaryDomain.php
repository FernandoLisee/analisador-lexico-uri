<?php

namespace App\Domain;

use Slim\Http\Request;

/**
 * Description of ListDictionaryDomain
 *
 * @author gusta
 */
class ListDictionaryDomain extends AbstractDomain {

    public function __invoke(Request $request): array {

        $analyzer = $this->container->get('analyzer');
        
        $dictionary = $analyzer->getAutomaton()->dictionary;

        return compact('dictionary');
    }

}
