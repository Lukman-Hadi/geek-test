<?php

function weightOfChars(string $string) {
    $weights = [];
    $n = strlen($string);
    $i = 0;

    while ($i < $n) {
        $currentChar = $string[$i];
        $charWeight = ord($currentChar) - ord('a') + 1;
        if (!in_array($charWeight, $weights)) {
            $weights[] = $charWeight;
        }

        $j = $i + 1;
        $currentSum = $charWeight;
        while ($j < $n && $string[$j] == $currentChar) {
            $currentSum += $charWeight;
            if (!in_array($currentSum, $weights)) {
                $weights[] = $currentSum;
            }
            $j += 1;
        }

        $i = $j;
    }

    return $weights;
}

function main(string $string, array $queries) {
    $weights = weightOfChars($string);
    $result = [];
    
    foreach ($queries as $query) {
        if (in_array($query, $weights)) {
            $result[] = "Yes";
        } else {
            $result[] = "No";
        }
    }

    return $result;
}



function runTestCases() {
    echo "----Weighted Strings-----\n";
    $testCases = [
        ["string" => "abbcccd", "queries" => [1, 3, 9, 8], "expected" => ["Yes", "Yes", "Yes", "No"]],
        ["string" => "abc", "queries" => [1, 2, 3, 4], "expected" => ["Yes", "Yes", "Yes", "No"]],
        ["string" => "zzzz", "queries" => [26, 52, 78, 104], "expected" => ["Yes", "Yes", "Yes", "Yes"]],
        ["string" => "aabb", "queries" => [1, 2, 3, 4], "expected" => ["Yes", "Yes", "No", "Yes"]],
        ["string" => "xyz", "queries" => [24, 25, 26, 27], "expected" => ["Yes", "Yes", "Yes", "No"]],
        ["string" => "aaa", "queries" => [2, 1, 5, 3,10,100], "expected" => ["Yes", "Yes", "No", "Yes", "No","No"]],
    ];
    $res = [];

    foreach ($testCases as $i=>$case) {
        echo "Case " . $i . "\n";
        $output = main($case["string"], $case["queries"]);
        $expected = $case["expected"];
        $result = ($output == $expected) ? "Pass" : "Fail";
        array_push($res,$result);
        echo "Result : $result\n";
        echo "string '{$case["string"]}', queries " . implode(", ", $case["queries"]). "\n";
        echo "Expected: " . implode(", ", $expected) . ", Got: " . implode(", ", $output) . "\n\n";
    }
    $numPass = array_count_values($res)["Pass"];
    $numFail = (@array_count_values($res)["Fail"])?(array_count_values($res)["Fail"]):0;
    echo "-----Results------\n";
    echo "total test cases: " . count($testCases) ." \n$numPass Passed\n$numFail Failed\n\n\n\n";
}

runTestCases();