<?php

namespace App\Action;

use App\Domain\BeginAnalyzerDomain;
use App\Responder\BeginAnalyzerResponder;

/**
 * Description of BeginAnalyzerAction
 *
 * @author gusta
 */
class BeginAnalyzerAction extends AbstractAction {

    /**
     *
     * @var BeginAnalyzerDomain
     */
    public $domain = BeginAnalyzerDomain::class;
    
    public $responder = BeginAnalyzerResponder::class;
    
}
