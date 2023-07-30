<?php

require dirname(__DIR__) . '/Period.php';
require dirname(__DIR__) . '/Chunk.php';
require dirname(__DIR__) . '/Exceptions/InvalidDateException.php';
require dirname(__DIR__) . '/SundayFortnightBase.php';
require dirname(__DIR__) . '/SundayFortnightA.php';

$sf = new \Periods\SundayFortnightA;

$chunk = $sf->chunk('2024-01-01');
var_dump($chunk->id(), $chunk->label(), $chunk->start(), $chunk->end());

$next = $chunk->next(); // same as $sf->next('2024-01-01');
var_dump($next->id(), $next->label(), $next->start(), $next->end());

$earlier = $next->offset(-10); // same as $sf->offset('2024-01-01', -10);
var_dump($earlier->id(), $earlier->label(), $earlier->start(), $earlier->end());
