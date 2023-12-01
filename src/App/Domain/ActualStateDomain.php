<?php

namespace App\Domain;

use \Slim\Http\Request;

/**
 * Description of ActualStateDomain
 *
 * @author gusta
 */
class ActualStateDomain extends AbstractDomain {

    /**
     * 
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array {
        
        $analyzer = $this->container->get("analyzer");
        
        $automaton = $analyzer->getAutomaton();
        
        return compact("automaton");
    }

}
