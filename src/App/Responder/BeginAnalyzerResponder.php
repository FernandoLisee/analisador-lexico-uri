<?php

namespace App\Responder;

use Slim\Http\Response;

/**
 * Description of BeginAnalyzerResponder
 *
 * @author gusta
 */
class BeginAnalyzerResponder extends AbstractResponder {
    
    /**
     * 
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public function __invoke(Response $response, array $data): Response {
        
        $automaton = $data["analyzer"]->getAutomaton();
        
        $dictionary = $automaton->dictionary;
        
        return $this->container->get('view')->render(
                $response, 'index.twig', 
                compact('automaton', 'dictionary'));
    }

}
