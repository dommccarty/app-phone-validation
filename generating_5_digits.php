<?php

/*
making the code.

5 digits = 62^5 = 916,132,832 possiblities

we will use all of them!

start with the prime of your choice. we use 413158523

store the counter somewhere.
*/

require("base_helpers.php");

function code_algorithm()
{

    $counter_filename = "codes_counter.txt"; //initialize it with "0"

    $fp = fopen($counter_filename, "r+");

    if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock. blocks until it succeeds.
        

        $counter = (int) trim(fgets($fp));
    
        $modulus = 916132832; // = 62^5
    
        $prime = 413158523;
    
    
        $next = ((++$counter) * $prime) % $modulus;
    
        $next = to_5_char_base_62($next);
    
        
        ftruncate($fp, 0);
        
        fwrite($fp, $counter);
        
        fflush($fp);            // flush output before releasing the lock
        
        flock($fp, LOCK_UN);    // release the lock

        return $next;
    } else {
        echo "Couldn't get the lock!";
    }
}
