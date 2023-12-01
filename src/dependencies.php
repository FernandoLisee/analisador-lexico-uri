<?php

use Psr\Container\ContainerInterface;
use LexicalAnalyzer\{
    Analyzer,
    Dictionary,
    FiniteAutomaton
};

$container = $app->getContainer();

$container['view'] = function (ContainerInterface $container) {

    $settings = $container->get('settings')["renderer"];

    $view = new \Slim\Views\Twig($settings["template_path"], $settings);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');

    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig\Extension\DebugExtension());

    return $view;
};

$container["storage"] = function () {

    $storage = new SlimSession\Helper();

    return $storage;
};

$container["analyzer"] = function (ContainerInterface $container) {

    $storage = $container->get("storage");

    $words = $storage->exists("dictionary") ? $storage->get("dictionary") : [];

    $dictionary = new Dictionary($words);

    $alphabet = range('a', 'z');

    $automaton = new FiniteAutomaton($alphabet, $dictionary);

    $automaton->lastState = $storage->exists("last_state") ? $storage["last_state"] : null;
    $automaton->actualSimbol = $storage->exists("actual_simbol") ? $storage["actual_simbol"] : null;
    $automaton->actualState = $storage->exists("actual_state") ? $storage["actual_state"] : 0;

    return new Analyzer(["automaton" => $automaton]);
};
