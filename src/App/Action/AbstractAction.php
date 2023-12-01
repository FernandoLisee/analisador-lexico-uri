<?php

namespace App\Action;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface as Container;
use Slim\Exception\NotFoundException;
use SlimAdr\AbstractContainerConstructor;

/**
 * Description of AbstractAction
 *
 * @author gusta
 */
abstract class AbstractAction extends AbstractContainerConstructor {
    
    /**
     *
     * @var AbstractDomain
     */
    protected $domain = null;
    
    /**
     *
     * @var AbstractResponder
     */
    protected $responder = null;
    

    public function __construct(Container $container) {
        
        parent::__construct($container);

        if(!class_exists($this->domain)) {
            throw new NotFoundException("Domain $this->domain is not implemented yet.", 500);
        }
        
        $this->domain = new $this->domain($container);
        
        if(!class_exists($this->responder)) {
            throw new NotFoundException("Domain $this->responder is not implemented yet.", 500);
        }
        
        $this->responder = new $this->responder($container);
    }

    /**
     * 
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response) {

        $data = $this->domain->__invoke($request);

        return $this->responder->__invoke($response, $data);
    }

}
