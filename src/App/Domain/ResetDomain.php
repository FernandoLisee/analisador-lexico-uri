<?php

namespace App\Domain;

use Slim\Http\Request;

/**
 * Description of ResetDomain
 *
 * @author gusta
 */
class ResetDomain extends AbstractDomain {
    
    
    public function __invoke(Request $request): array {
        
        \SlimSession\Helper::destroy();
        
        return ['session' => 'destroyed'];
    }

}
