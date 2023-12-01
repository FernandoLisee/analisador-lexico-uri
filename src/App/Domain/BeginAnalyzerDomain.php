<?php

namespace App\Domain;

use Slim\Http\Request;

/**
 * Description of BeginAnalyzerDomain
 *
 * @author gusta
 */
class BeginAnalyzerDomain extends AbstractDomain {
    
    /**
     * 
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array {
        
        $analyzer = $this->container->get("analyzer");
        
        $analyzer->getAutomaton()->restart();
        
        return compact('analyzer');
    }

}
