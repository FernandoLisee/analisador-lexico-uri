<?php

use App\Action\{
    BeginAnalyzerAction,
    ReadAction,
    ActualStateAction,
    ResetAction,
    AddToDictionaryAction,
    ListDictionaryAction,
    RemoveFromDictionaryAction
};

/**
 * GET
 */

$app->get('/', BeginAnalyzerAction::class)->setName('begin');

$app->get('/actual-state', ActualStateAction::class)->setName('actual-state');

$app->get('/dictionary', ListDictionaryAction::class)->setName('dictionary');

/**
 * PUT
 */

$app->put('/read', ReadAction::class)->setName('read');

/**
 * ´PATCH
 */

$app->patch('/dictionary/add', AddToDictionaryAction::class)->setName('add-word');

/**
 * DELETE
 */

$app->delete('/reset', ResetAction::class)->setName('reset');

$app->delete('/dictionary/remove', RemoveFromDictionaryAction::class)->setName('remove-word');

