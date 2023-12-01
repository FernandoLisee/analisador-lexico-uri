<?php

namespace LexicalAnalyzer;

/**
 * Description of State
 *
 * @author gusta
 */
class State implements \ArrayAccess {
    
    /**
     * The index of the state in the FiniteAutomaton
     * @var int
     */
    private $index;
    
    /**
     * Associative array that determinizes the rules of the state
     * @var array
     */
    private $rules;
    
    /**
     * Identify the state as Finish
     * @var bool
     */
    private $isFinish = true;
    
    /**
     * 
     * @param int $index
     * @param array $rules
     */
    public function __construct(int $index = 0, array $rules = []) {
        
        $this->index = $index;
        
        $this->setRules($rules);
    }
    
    /**
     * 
     * @param string $char
     * @return bool
     */
    public function hasRule(string $char): bool {
        
        return isset($this->rules[$char]);
    }
    
    public function addRule(string $char, int $stateTo): void {
        
        $this->offsetSet($char, $stateTo);
    }
    
    public function getRule(string $char): int {
        
        return $this->offsetGet($char);
    }
    
    /**
     * 
     * @return int
     */
    public function getIndex(): int {
        
        return $this->index;
    }

    /**
     * 
     * @return array
     */
    public function getRules(): array {
        
        return $this->rules;
    }

    /**
     * 
     * @param int $index
     * @return $this
     */
    public function setIndex(int $index) {
        
        $this->index = $index;
        
        return $this;
    }

    /**
     * 
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules) {
        
        $this->rules = $rules;
        
        if(!empty($this->rules)) {
            
            $this->isFinish = false;
        }
        
        return $this;
    }
    
    /**
     * 
     * @return bool
     */
    public function isFinish(): bool {
        
        return $this->isFinish;
    }

    /**
     * Implements ArrayAccess::offsetExists<br>
     * State as array represents the Rules array of $this->rules
     * 
     * @param string $char
     * @return bool
     */
    public function offsetExists($char): bool {
        
        return isset($this->rules[$char]);
    }

    /**
     * Implements ArrayAccess::offsetGet<br>
     * State as array represents the Rules array of $this->rules
     * 
     * @param string $char
     * @return int
     * @throws \InvalidArgumentException
     */
    public function offsetGet($char) {
        
        if(!isset($this->rules[$char])) {
            
            throw new \InvalidArgumentException(
                    "There's no rule for '$char' at state of index $this->index");
        }
        
        return $this->rules[$char];
    }

    /**
     * Implements ArrayAccess::offsetSet<br>
     * State as array represents the Rules array of $this->rules
     * 
     * @param string $char
     * @param int $stateTo
     */
    public function offsetSet($char, $stateTo): void {
        
        $this->rules[$char] = $stateTo;
        
        $this->isFinish = false;
    }

    /**
     * Implements ArrayAccess::offsetUnset<br>
     * State as array represents the Rules array of $this->rules
     * 
     * @param string $char
     */
    public function offsetUnset($char): void {
        
        unset($this->rules[$char]);
        
        if(empty($this->rules)) {
            
            $this->isFinish = true;
        }
    }

}
