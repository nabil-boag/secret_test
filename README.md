Secret Test
===========

This script tests a "secret()" function with all the prime numbers below a specified limit.

This script does the following:
* Takes the first argument from the command line as the limit
* Gets all the prime numbers up to the specified limit
* Checks if the "secret()" function is additive using the primes and prints a message


How to Run
==========

In your environment, ensure you have PHP installed.

Change into the root directory of the project and run the following:

```bash
php secret_test.php 10
```

If the secret function **is** additive, the script will output:

```bash
The secret function is additive with prime numbers under 10.
```

If the secret function **is not** additive, the script will output:

```bash
The secret function is not additive with prime numbers under 10.
```

