<?php

namespace App\Action;

use App\Domain\ResetDomain;
use App\Responder\ResetResponder;

/**
 * Description of ResetAction
 *
 * @author gusta
 */
class ResetAction extends AbstractAction {
    
    public $domain = ResetDomain::class;
    
    public $responder = ResetResponder::class;
}
