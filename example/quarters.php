<?php

require dirname(__DIR__) . '/classes/Period.php';
require dirname(__DIR__) . '/classes/Chunk.php';
require dirname(__DIR__) . '/classes/Exceptions/InvalidDateException.php';
require dirname(__DIR__) . '/classes/Quarter.php';
require dirname(__DIR__) . '/classes/QuarterMinus3.php';
require dirname(__DIR__) . '/classes/QuarterMinus2.php';
require dirname(__DIR__) . '/classes/QuarterMinus1.php';
require dirname(__DIR__) . '/classes/QuarterPlus1.php';
require dirname(__DIR__) . '/classes/QuarterPlus2.php';
require dirname(__DIR__) . '/classes/QuarterPlus3.php';

$quarter_names = [
    'QuarterMinus3',
    'QuarterMinus2',
    'QuarterMinus1',
    'Quarter',
    'QuarterPlus1',
    'QuarterPlus2',
    'QuarterPlus3',
];

$quarters = array_map(fn ($name) => ($class = '\\Periods\\' . $name) ? new $class : null, array_combine($quarter_names, $quarter_names));

echo "-------------------------------------------------------------------------------------------------------\n";
echo "|                                                2023                                                 |\n";
echo "-------------------------------------------------------------------------------------------------------\n";
echo "|                | Q1 start       | Q2 start       | Q3 start       | Q4 start       | Q4 end         |\n";
echo "-------------------------------------------------------------------------------------------------------\n";

foreach ($quarters as $label => $period) {
    $chunk = null;

    for ($date = '2022-04-01'; strcmp($date, '2023-10-02') < 0; $date = date('Y-m-d', strtotime('+3 months', strtotime($date)))) {
        if (($_chunk = $period->chunk($date))->label() == 'Q1 2023') {
            $chunk = $_chunk;
            break;
        }
    }

    // label

    echo '|';
    echo ' ' . str_pad($label, 15) . '|';

    // Q1
    echo ' ' . str_pad($chunk->start(), 15) . '|';

    // Q2
    $chunk = $chunk->next();
    echo ' ' . str_pad($chunk->start(), 15) . '|';

    // Q3
    $chunk = $chunk->next();
    echo ' ' . str_pad($chunk->start(), 15) . '|';

    // Q4
    $chunk = $chunk->next();
    echo ' ' . str_pad($chunk->start(), 15) . '|';
    echo ' ' . str_pad($chunk->end(), 15) . '|';

    echo "\n";
}

echo "-------------------------------------------------------------------------------------------------------\n";
