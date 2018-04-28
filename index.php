<?php
/**
 * Headers checking script
 *
 * Simple script for checking http code of URL list and filter if necessary. Can be easy used for checking 404 codes for site and getting list of 404 error pages.
 *
 * @category Utility
 * @author Jan Drda <jdrda@outlook.com>
 * @copyright Jan Drda
 * @license https://opensource.org/licenses/MIT MIT
 */

/**
 * CONFIGURATION
 */
define('SOURCE_FILE', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source.csv'); // source file with urls
define('DESTINATION_FILE', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'destination.csv'); // source file with urls

/**
 * Disable SSL verification
 */
stream_context_set_default( array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
    ),
));

/**
 * Open destination for writing
 */
if(!$destinationFilePointer = @fopen(DESTINATION_FILE, 'w')){
    echo "FATAL ERROR: destination file cannot be opened!";
    exit();
}
else{
    echo "Destionation file opened for writing" . PHP_EOL;
}

/**
 * Read each and every row
 */
if (($handle = fopen(SOURCE_FILE, "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {

        echo "Reading source file ..." . PHP_EOL;

        $url = trim($data[0]);

        /**
         * Check if valid URL
         */
        if (!filter_var($url, FILTER_VALIDATE_URL)) {

            echo $url . " | WARNING: URL not valid" . PHP_EOL;
            $responseCode = -1; // Set code -1 for invalid URL
        }
        else {

            echo "URL OK | "  . $url . PHP_EOL;
            if(!$headers = get_headers($url)){
                echo "ERROR: Getting headers failed" .PHP_EOL ; // Set code -2 if checking files filed
                $responseCode = -2;
            }
            else {
                $responseCode = substr($headers[0], 9, 3);
            }
        }

        echo "Response code: " . $responseCode . " ... saving" . PHP_EOL;

        /**
         * Save result to file
         */
        fputcsv($destinationFilePointer, array($url, $responseCode));

    }
    fclose($handle);
}
else{
    echo "ERROR: Cannot read source file!";
}