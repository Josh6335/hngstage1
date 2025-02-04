<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClassifyNumberController extends Controller
{
    public function classifyNumber(Request $request)
    {
        // Validate input
        $number = $request->query('number');

        if (!is_numeric($number) || intval($number) != $number) {
            return response()->json([
                "number" => "alphabet",
                "error" => true
            ], 400);
        }

        $number = intval($number);

        // Determine properties
        $is_prime = $this->isPrime($number);
        $is_perfect = $this->isPerfect($number);
        $is_armstrong = ($number > 0) ? $this->isArmstrong($number) : false; // this is to check for positive, non-zero Armstrong numbers
        $digit_sum = array_sum(str_split(abs($number))); 

        // Determine properties array
        $properties = [];
        if ($is_armstrong && $number > 0) { // this ensure only positive Armstrong numbers are considered
            $properties[] = "armstrong";
        }
        $properties[] = $number % 2 === 0 ? "even" : "odd";

        // Fetch fun fact
        $fun_fact = $this->getFunFact($number);

        return response()->json([
            "number" => $number,
            "is_prime" => $is_prime,
            "is_perfect" => $is_perfect,
            "properties" => $properties,
            "digit_sum" => $digit_sum,
            "fun_fact" => $fun_fact
        ], 200);
    }

    private function isPrime($num)
    {
        if ($num < 2) return false; // No negative integer or 1 as prime
        if ($num == 2) return true; // Special case for 2

        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i == 0) return false;
        }
        return true;
    }

    private function isPerfect($num)
    {
        if ($num < 1) return false; // Perfect numbers are only positive

        $sum = 0;
        for ($i = 1; $i < $num; $i++) {
            if ($num % $i == 0) $sum += $i;
        }
        return $sum == $num;
    }

    private function isArmstrong($num)
    {
        // Armstrong numbers are only defined for positive integers
        $digits = str_split($num);
        $power = count($digits);
        return array_sum(array_map(fn($d) => pow($d, $power), $digits)) == $num;
    }

    private function getFunFact($num)
    {
        $response = Http::get("http://numbersapi.com/{$num}/math?json");
        return $response->successful() ? $response->json()['text'] : "No fun fact available.";
    }
}
