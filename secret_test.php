<?php

/**
 * Takes a number and returns a number
 *
 * @param int $number an integer parameter
 * @return int A number
 */
function secret($number) {
    return $number;
}

/**
 * Takes a number and returns an array of prime numbers up to the specified limit.
 *
 * This function implements the Sieve of Eratosthenes algorithm to find the prime numbers
 *
 * @param int $limit The number that all primes must be less than
 * @return array|bool An array of prime integers or false if none could be found
 */
function getPrimesUpToLimit($limit) {

    if ( ! is_int($limit) || $limit <= 1) {
        // The limit is not a number or it is less then 1 (1 is not a prime number!)
        return false;
    }

    // The maximum prime is the square root of the limit
    $maxNumber = sqrt($limit);

    // Make an associative array keyed by numbers from 2 to n - 1 with the value true
    $potentialPrimes = array_fill(2, $limit-1, true);

    // An array to return all the confirmed prime numbers
    $primes = array();

    // Now we need to flag the non prime numbers from the array starting at 2
    for ($i = 2; $i <= $maxNumber; $i++) {
        for ($j = $i * $i; $j < $limit; $j += $i) {
            // This number is not a prime so set the flag to false
            $potentialPrimes[$j] = false;
        }
    }

    // Starting at 2 (1 is not a prime!) add all the primes to the return array
    for ($i = 2; $i < $limit; $i++) {
        if ($potentialPrimes[$i]) {
            // This number is a prime so add it to the return array
            $primes[] = $i;
        }
    }

    return $primes;
}

/**
 * Takes an array of number and returns true if the secret function is additive
 *
 * @param array numbers An array of numbers to pass into the secret function
 * @return bool True if the secret function is additive, false otherwise
 */
function isSecretAdditive($numbers) {
    // Stores all the numbers that have already been checked by this function
    $checked = array();

    foreach ($numbers as $outerNumber) {
        foreach ($numbers as $innerNumber) {
            if ( ! isset($checked[$innerNumber])) {
                // We have not checked this number
                $addedNums = $outerNumber + $innerNumber;
                // Get the result of the secret function with the added numbers
                $addedSecretResult = secret($addedNums);
                // Get the result of the secret function with the outer number
                $outerSecretResult = secret($outerNumber);
                // Get the result of the secret function with the inner number
                $innerSecretResult = secret($innerNumber);
                // Add the two local results together to compare to the added result
                $manuallyAddedResult = $outerSecretResult + $innerSecretResult;

                if ($addedSecretResult != $manuallyAddedResult) {
                    // The secret function failed the additive test!
                    return false;
                }
            }
        }
        // Add the outer number to the checked list
        $checked[$outerNumber] = true;
    }
    // If we got to here it means all the secret function was additive with all the inputs
    return true;
}

// Get the first argument from the command line and convert it to an integer
$limit = (int)$argv[1];

// Get all the prime numbers up to the limit specified
$primes = getPrimesUpToLimit($limit);
// Using the primes specified, check if the secret function is additive
if ($primes && isSecretAdditive($primes)) {
    echo "The secret function is additive with prime numbers under {$limit}.\n";
} else {
    echo "The secret function is not additive with prime numbers under {$limit}.\n";
}
