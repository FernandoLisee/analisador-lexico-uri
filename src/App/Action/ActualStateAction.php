<?php

namespace App\Action;

use App\Domain\ActualStateDomain;
use App\Responder\ActualStateResponder;

/**
 * Description of ActualStateAction
 *
 * @author gusta
 */
class ActualStateAction extends AbstractAction {

    public $domain = ActualStateDomain::class;
    
    public $responder = ActualStateResponder::class;
}
