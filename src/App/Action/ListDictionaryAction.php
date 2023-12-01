<?php

namespace App\Action;

use App\Domain\ListDictionaryDomain;
use App\Responder\ListDictionaryResponder;

/**
 * Description of ListDictionaryAction
 *
 * @author gusta
 */
class ListDictionaryAction extends AbstractAction {
    
    public $domain = ListDictionaryDomain::class;
    
    public $responder = ListDictionaryResponder::class;
}
