<?php
//Slot machine
//Bilance
//Jāievada likme
//Līnijas
//Payout
//Tehniskā daļa neatkarīga no vizuālās daļas


$moneyLeft = 500;
while($moneyLeft > 5) {

    $board = [];
    $rows = 3;
    $columns = 4;

    $validBets = [
        5,
        10,
        20,
        40,
        80,
        99
    ];

    $symbols = [
        "J", "J", "J", "J", "J",
        "Q", "Q", "Q", "Q",
        "K", "K", "K",
        "A", "A",
    ];

    $payoutOptions = [
        5 => "J",
        10 => "Q",
        15 => "K",
        50 => "A"
    ];

    $conditions = [
        [
            [0, 0], [0, 1], [0, 2], [0, 3]
        ],
        [
            [1, 0], [1, 1], [1, 2], [1, 3]
        ],
        [
            [2, 0], [2, 1], [2, 2], [2, 3]
        ],
        [
            [0, 0], [1, 1], [2, 2], [2, 3]
        ],
        [
            [0, 0], [0, 1], [1, 2], [2, 3]
        ],
        [
            [2, 0], [1, 1], [0, 2], [0, 3]
        ],
        [
            [2, 0], [2, 1], [1, 2], [0, 3]
        ],
    ];

    echo "You have $" . $moneyLeft . " left" . PHP_EOL;
    $bet = readline("Please enter your bet(" . implode(", ",$validBets) . "): ");
    if(!in_array($bet, $validBets)){
        echo "Please enter a valid bet amount!" . PHP_EOL;
        continue;
    }


    $lineWinAmount = 0;
    $totalWinAmount = 0;


    for ($r = 0; $r < $rows; $r++) {
        for ($c = 0; $c < $columns; $c++) {
            $board[$r][$c] = $symbols[array_rand($symbols)];
        }
    }

    foreach ($board as $row) {
        echo PHP_EOL;
        foreach ($row as $symbol) {
            echo $symbol . " ";
        }
    }


    foreach ($conditions as $condition) {
        $x = [];
        foreach ($condition as $position) {
            $row = $position[0];
            $column = $position[1];

            $x[] = $board[$row][$column];
        }

        if (count(array_unique($x)) == 1) {
            $symbolToSearch = $x[0];

            if (isset($payoutOptions, $symbolToSearch)) {
                $winCoefficient = array_search($symbolToSearch, $payoutOptions);
                $lineWinAmount = $bet * $winCoefficient;
                $moneyLeft += $lineWinAmount;
            }
        $totalWinAmount += $lineWinAmount;
        }
    }
    if($lineWinAmount > 0){
        echo "Congratulations! You win:" . $totalWinAmount . PHP_EOL;
    }
    $moneyLeft = $moneyLeft - $bet;




}

echo "You have $" . $moneyLeft . " left" . PHP_EOL;
echo "Visa alga zaudēta. :(" . PHP_EOL;
