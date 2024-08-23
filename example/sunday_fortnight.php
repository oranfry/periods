<?php

require dirname(__DIR__) . '/classes/Period.php';
require dirname(__DIR__) . '/classes/Chunk.php';
require dirname(__DIR__) . '/classes/Exceptions/InvalidDateException.php';
require dirname(__DIR__) . '/classes/SundayFortnightBase.php';
require dirname(__DIR__) . '/classes/SundayFortnightA.php';

$sf = new \Periods\SundayFortnightA;

$chunk = $sf->chunk('2024-01-01');
var_dump($chunk->id(), $chunk->label(), $chunk->start(), $chunk->end());

$next = $chunk->next(); // same as $sf->next('2024-01-01');
var_dump($next->id(), $next->label(), $next->start(), $next->end());

$earlier = $next->offset(-10); // same as $sf->offset('2024-01-01', -10);
var_dump($earlier->id(), $earlier->label(), $earlier->start(), $earlier->end());
