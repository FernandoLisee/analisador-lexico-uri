<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LexicalAnalyzer;

/**
 * Description of Token
 *
 * @author gusta
 */
class Token {

    /**
     *
     * @var string
     */
    private $token;
    
    /**
     *
     * @var string
     */
    private $trueToken;

    /**
     *
     * @var array
     */
    private $chars;

    /**
     * 
     * @param string $token
     */
    public function __construct(string $token) {

        $this->token = str_replace(Tokenizer::$epsylon, '', $token);
        
        $this->trueToken = $token;

        $this->chars = str_split(mb_strtolower($this->token));
    }

    /**
     * 
     * @return string
     */
    public function __toString(): string {

        return $this->token;
    }
    
    /**
     * 
     * @return array
     */
    public function toArray(): array {
        return $this->chars;
    }
    
    /**
     * 
     */
    public function isComplete(): bool {
        
        $isComplete = strpos(
            $this->trueToken, 
            Tokenizer::$epsylon
        );
        
        return ($isComplete !== false);
    }

}
