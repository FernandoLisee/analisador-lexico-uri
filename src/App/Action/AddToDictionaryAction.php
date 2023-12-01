<?php

namespace App\Action;

use App\Domain\AddToDictionaryDomain;
use App\Responder\AddToDictionaryResponder;

/**
 * Description of AddToDictionaryAction
 *
 * @author gusta
 */
class AddToDictionaryAction extends AbstractAction {

    public $domain = AddToDictionaryDomain::class;
    
    public $responder = AddToDictionaryResponder::class;
}
