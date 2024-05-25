<?php

function balancedBracket(string $string):string {
    $cleaned = cleanInput($string);
    $set = [
        "}"=>"{",
        ")"=>"(",
        "]"=>"["
        ];
    $tempStack = [];
    $arr = str_split($cleaned);
    foreach($arr as $key => $val) {
        if (!empty($set[$val])) {
            if ($key == 0) return "No"; // if begin with closing
            if ($tempStack[count($tempStack)-1]!==$set[$val]) return "No";
            array_pop($tempStack);
            continue;
        }
        array_push($tempStack,$val);
    }
    return empty($tempStack)?"Yes":"No";
}

function cleanInput(string $string):string {
    $cleaned = preg_replace("/\s/","",$string);
    if (preg_match("/[^(){}[\]]/",$cleaned)) throw new \Exception("Invalid Input");
    return $cleaned;
}

function runTestCases() {
    echo "----Balanced Brackets-----\n";
    $testCases = [
        ["string" => "{{}}", "expected" => "Yes","expectException"=>false],
        ["string" => "{){}", "expected" => "No","expectException"=>false],
        ["string" => "()(]){}", "expected" => "No","expectException"=>false],
        ["string" => ")()()[]", "expected" => "No","expectException"=>false],
        ["string" => "((([[[{{{}}}]]])))", "expected" => "Yes","expectException"=>false],
        ["string" => "((([[[{{{s}}}]]])))", "expected" => null,"expectException"=>true],
        ["string" => "()(){}{}[][][[({})]]{[()]}", "expected" => "Yes","expectException"=>false],
        ["string" => "()(){}{}[][][[({})]]{[(])}", "expected" => "No","expectException"=>false],
        ["string" => "( )( ){
            
        }{ }[
            
        ][
            
        ][
            [ (
                    {    
                        
                    }   
                      )
                      
                        ]
        ]
            {
                [
                    (
                           
                    )   ]   }", "expected" => "Yes","expectException"=>false]
    ];
    $res = [];

    foreach ($testCases as $i=>$case) {
        $output = null;
        echo "Case " . ($i+1) . "\n";
        try {
            $output = balancedBracket($case["string"]);
            $expected = $case["expected"];
            $result = (($output == $expected) && !$case["expectException"]) ? "Pass" : "Fail";
        } catch (\Exception $ex) {
            $expected = $case["expected"];
            $result = $case["expectException"]?"Pass":"Fail";
        }
        array_push($res,$result);
        echo "Result : $result\n";
        echo "string '{$case["string"]}'\n";
        echo "Expected: $expected, Got: $output\n\n";
    }
    $numPass = array_count_values($res)["Pass"];
    $numFail = (@array_count_values($res)["Fail"])?(array_count_values($res)["Fail"]):0;
    echo "-----Results------\n";
    echo "total test cases: " . count($testCases) ." \n$numPass Passed\n$numFail Failed\n\n\n";
}

runTestCases();