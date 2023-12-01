<?php

namespace LexicalAnalyzer;

/**
 * Description of FiniteAutomata
 *
 * @author gusta
 */
class FiniteAutomaton {

    /**
     * Alphabet for the automaton
     * @var array 
     */
    private $alphabet = [];

    /**
     *
     * @var Dictionary
     */
    private $dictionary;

    /**
     *
     * @var array of State
     */
    private $states = [];

    /**
     *
     * @var int Index of the actual State
     */
    private $actualState = 0;

    /**
     *
     * @var string
     */
    private $actualSimbol;

    /**
     *
     * @var int Index of the last State
     */
    private $lastState = null;

    /**
     * 
     * @param \LexicalAnalyzer\Dictionary $dictionary
     */
    public function __construct(array $alphabet = [], Dictionary $dictionary = null) {

        sort($alphabet);

        $this->alphabet = $alphabet;

        $this->dictionary = $dictionary ? $dictionary : new Dictionary();

        $this->build();
    }

    /**
     * Builds the internal States of the Automaton
     */
    public function build() {

        $dictionary = $this->dictionary->asTokenizer();

        if (!$dictionary->isEmpty()) {

            $states = [new State];

            $token = $dictionary->first();

            do {
                $stateIndex = 0;

                foreach ($token->toArray() as $character) {

                    if (!$states[$stateIndex]->hasRule($character)) {

                        $nextStateIndex = end($states)->getIndex() + 1;

                        $states[$stateIndex]->addRule($character, $nextStateIndex);

                        if (!isset($states[$nextStateIndex])) {

                            $states[$nextStateIndex] = new State($nextStateIndex);

                            $stateIndex = $nextStateIndex;
                        }
                    } else {

                        $stateIndex = $states[$stateIndex]->getRule($character);
                    }
                }
            } while ($token = $dictionary->next());

            $this->states = $states;
        }
    }

    /**
     * 
     * @param \LexicalAnalyzer\Token $word
     */
    public function wordIsValid(Token $word): \stdClass {

        // verifica se há um alfabeto setado para os automatos
        if (empty($this->alphabet)) {

            throw new \Exception("afebeto registrado.", 500);
        }

        $isValid = false;

        $validation = new \stdClass;
        $validation->word = $word->__toString();
        $validation->isComplete = $word->isComplete();
        $validation->valid = $isValid;

        // invalido por padrão se não há palavras no dicionário
        if (empty($this->dictionary->toArray())) {

            return $validation;
        }

        foreach ($word->toArray() as $char) {

            $this->actualSimbol = $char;

            // se o caractere não faz parte do alfabeto a palavra não é valida
            if (!in_array($char, $this->alphabet)) {

                $isValid = false;

                break;
            }

            $isValid = $this->passState($char);

            if (!$isValid) {

                break;
            }
        }

        $validation->valid = $isValid;

        return $validation;
    }

    /**
     * 
     * @param string $char
     * @return boolean
     */
    protected function passState(string $char) {

        $actual = $this->states[$this->actualState];

        $nextStateIndex = isset($actual[$char]) ? $actual[$char] : false;

        if ($nextStateIndex === false) {

            return false;
        }

        $this->lastState = $actual->getIndex();

        $this->actualState = $this->states[$nextStateIndex]->getIndex();

        return true;
    }

    public function restart() {

        $this->actualState = 0;
        
        $this->actualSimbol = null;

        $this->lastState = null;
    }

    public function __set($name, $value) {
        $this->{$name} = $value;
    }

    public function __get($name) {
        return $this->{$name};
    }

    /*
     * Getters for Twig View 
     */

    public function getAlphabet() {
        return $this->alphabet;
    }

    public function getDictionary(): Dictionary {
        return $this->dictionary;
    }

    public function getStates() {
        return $this->states;
    }

    public function getActualState() {
        return $this->actualState;
    }

    public function getLastState() {
        return $this->lastState;
    }

    public function getActualSimbol() {
        return $this->actualSimbol;
    }

}
