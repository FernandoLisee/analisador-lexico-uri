<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LexicalAnalyzer;

/**
 *
 * @author gusta
 */
trait LexicalAnalyzerResponderTrait {

    protected function formatReadResponse($element) {
        switch ($element->valid) {
            case true:
                $element->valid = 'valid';
                break;
            case false:
                $element->valid = 'invalid';
                break;
            default:
                $element->valid = null;
                break;
        }

        return $element;
    }

}
