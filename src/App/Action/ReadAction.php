<?php

namespace App\Action;

use App\Domain\ReadDomain;
use App\Responder\ReadResponder;

/**
 * Description of ReadAction
 *
 * @author gusta
 */
class ReadAction  extends AbstractAction{
    
    public $domain = ReadDomain::class;
    public $responder = ReadResponder::class;
}
