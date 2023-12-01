<?php

namespace LexicalAnalyzer;

/**
 * Description of Dictionary
 *
 * @author gusta
 */
class Dictionary {

    /**
     *
     * @var array
     */
    private $words = [];
    
    /**
     * 
     * @param array $words
     */
    public function __construct(array $words = []) {
        
        $this->words = $words;
    }

    /**
     * 
     * @param string $word
     */
    public function add(string $word) {

        if (!$this->exists($word) && !empty($word)) {

            $this->words[] = $word;

            sort($this->words);
        }
    }

    /**
     * 
     * @param string $word
     * @return boolean
     */
    public function remove(string $word): bool {

        if (!$this->exists($word)) {

            return false;
        }

        unset($this->words[array_search($word, $this->words)]);

        sort($this->words);

        return true;
    }

    /**
     * 
     * @param string $word
     * @return bool
     */
    public function exists(string $word): bool {

        return in_array($word, $this->words);
    }

    /**
     * 
     * @return array
     */
    public function toArray(): array {

        return $this->words;
    }

    /**
     * 
     * @return \LexicalAnalyzer\Tokenizer
     */
    public function asTokenizer(): Tokenizer {

        $tokens = !empty($this->words) ? implode(' ', $this->words) . ' ' : '';

        $tokenizer = new Tokenizer($tokens);

        return $tokenizer;
    }

}
