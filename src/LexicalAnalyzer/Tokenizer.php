<?php

namespace LexicalAnalyzer;

/**
 * Description of TOkenizer
 *
 * @author gusta
 */
class Tokenizer {

    /**
     *
     * @var string
     */
    public static $delimiter = " ";
    
    /**
     *
     * @var string
     */
    public static $epsylon = "{end}";

    /**
     *
     * @var string
     */
    private $tokenized;

    /**
     *
     * @var array of Token
     */
    private $tokens = [];

    /**
     * 
     * @param string $tokenizedString
     */
    public function __construct(string $tokenizedString) {

        $this->tokenized = $tokenizedString;

        $this->tokenize();
    }

    /**
     * Generate tokens;
     */
    protected function tokenize() {

        $this->tokenized = str_replace(
            self::$delimiter, 
            self::$epsylon . self::$delimiter, 
            $this->tokenized
        );
        
        $stringTokens = explode(self::$delimiter, $this->tokenized);

        foreach ($stringTokens as $stringToken) {
            if (!empty($stringToken)) {
                $this->tokens[] = new Token($stringToken);
            }
        }

        reset($this->tokens);
    }

    /**
     * 
     * @return Token
     */
    public function current() {

        return current($this->tokens);
    }
    
    /**
     * 
     * @return Token
     */
    public function first() {
        
        return reset($this->tokens);
    }

    /**
     * 
     * @return Token
     */
    public function next() {

        return next($this->tokens);
    }

    /**
     * 
     * @return Token
     */
    public function end() {

        return end($this->tokens);
    }

    public function __toString() {

        return $this->tokenized;
    }

    public function isEmpty() {

        return empty($this->tokenized);
    }

    public static function getDelimiter() {
        return self::$delimiter;
    }

    public static function setDelimiter($delimiter) {
        self::$delimiter = $delimiter;
        return self;
    }

    public static function resetDelimiter() {
        self::$delimiter = ' ';
        return self;
    }

}
