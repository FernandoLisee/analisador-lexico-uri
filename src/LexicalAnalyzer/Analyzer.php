<?php

namespace LexicalAnalyzer;

/**
 * Classe Analyzer responsável pela análise léxica.
 */
class Analyzer {

    /**
     * Constante OPTIONS - Define opções padrão para o analisador.
     */
    const OPTIONS = [];

    /**
     * @var FiniteAutomaton
     * Instância de um autômato finito para o processo de análise.
     */
    private $automaton;

    /**
     * Construtor da classe.
     * @param array $options Opções para configurar o analisador.
     */
    public function __construct(array $options = []) {
        // Mescla as opções padrão com as opções fornecidas.
        $options = array_merge(self::OPTIONS, $options);

        // Configura o autômato finito com base nas opções fornecidas.
        $this->automaton = isset($options["automaton"]) ?
                $options["automaton"] : new FiniteAutomaton(
                isset($options["alphabet"]) ? $options["alphabet"] : range('a', 'z'), 
                isset($options["dictionary"]) ? $options["dictionary"] : new Dictionary()
        );
    }
        
    /**
     * Salva o estado do autômato na sessão.
     * @param SlimSession\Helper $storage Objeto de armazenamento da sessão.
     */
    public function saveState($storage) {
        // Salva informações do estado atual do autômato na sessão.
        $storage->set('last_state', $this->automaton->lastState);
        $storage->set('actual_state', $this->automaton->actualState);
        $storage->set('actual_simbol', $this->automaton->actualSimbol);
        $storage->set("dictionary", $this->automaton->dictionary->toArray());
        $storage->set("alphabet", $this->automaton->alphabet);
    }

    /**
     * Adiciona uma palavra ao dicionário do autômato.
     * @param \LexicalAnalyzer\Token $token Token representando a palavra.
     * @throws \InvalidArgumentException Lança exceção se o token estiver vazio.
     */
    public function addWord(Token $token) {
        if (empty($token->__toString())) {
            throw new \InvalidArgumentException("Analyzer::addWord(Token) expects a "
            . "non empty Token, empty passed.", 500);
        }
        $this->automaton->dictionary->add($token->__toString());
        $this->automaton->build();
    }
    
    /**
     * Remove uma palavra do dicionário do autômato.
     * @param \LexicalAnalyzer\Token $token Token representando a palavra.
     * @throws \InvalidArgumentException Lança exceção se o token estiver vazio.
     */
    public function removeWord(Token $token) {
        if (empty($token->__toString())) {
            throw new \InvalidArgumentException("Analyzer::removeWord(Token) expects a "
            . "non empty Token, empty passed.", 500);
        }
        $this->automaton->dictionary->remove($token->__toString());
        $this->automaton->build();
    }

    /** BACKTRAKING
     * Processa a entrada usando um tokenizer.
     * @param \LexicalAnalyzer\Tokenizer $tokenizer Tokenizer para processar a entrada.
     * @return array Retorna um array de validações para cada token processado.
     */
    public function readInput(Tokenizer $tokenizer): array {
        $read = [];
        if ($tokenizer->isEmpty()) {
            $this->automaton->restart();
            $reset = new \stdClass;
            $reset->word = '...';
            $reset->valid = null;
            return [$reset];
        }
        $token = $tokenizer->first();
        do {
            $this->automaton->restart();
            $validation = $this->automaton->wordIsValid($token);
            $read[] = $validation;
        } while ($token = $tokenizer->next());
        return $read;
    }

    /**
     * Retorna o autômato finito.
     * @return \LexicalAnalyzer\FiniteAutomaton Retorna a instância do autômato finito.
     */
    public function getAutomaton(): FiniteAutomaton {
        return $this->automaton;
    }

}
