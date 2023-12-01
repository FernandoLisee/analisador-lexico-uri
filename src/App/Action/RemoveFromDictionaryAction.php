<?php

namespace App\Action;

use App\Domain\RemoveFromDictionaryDomain;
use App\Responder\RemoveFromDictionaryResponder;

/**
 * Description of RemoveFromDictionaryAction
 *
 * @author gusta
 */
class RemoveFromDictionaryAction extends AbstractAction {

    public $domain = RemoveFromDictionaryDomain::class;
    
    public $responder = RemoveFromDictionaryResponder::class;
}
