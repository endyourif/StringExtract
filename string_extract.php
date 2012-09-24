<?php
/***************************************************
* StringExtract Component
* 
* In Visual FoxPro there is an excellent function called STREXTRACT
* that allows you to pass in a start and optional end delimiter
* and it returns the text between the start and end delimiter.
* 
* This is a PHP version of the same function to save time having
* to find and substring it each time.
* 
* @copyright    Copyright 2009, Jamie Munro
* @link         http://www.endyourif.com
* @author       Jamie Munro
* @version      1.0
* @license      MIT
*/
class StringExtractComponent extends Object {
	/*************************************************
	* str_extract parses out and returns the text specified between start and end delimiters
	* 
	* @param string $content String containing the content to parse
	* @param string $begindelim String containing the text of where to start parsing
	* @param string $enddelim String containing the text of where to end parsing
	* @param int $occur Integer defining which instance of the $begin parameter
	* @return string
	* @access public
	*/
	function str_extract($content, $begindelim, $enddelim = "", $occur = 0) {
		$parsedContent = "";
		// don't bother doing any work if content is empty
		if (strlen($content)) {
			$count = 0;
			$start = 0;
			// start a loop for the occurance
			do {
			
				// get the starting position of the content
				$start = strpos($content, $begindelim, $start);
				
				// don't bother doing any more if start was not found
				if ($start === false) {
					break;
				} else {
					// since we found it, we want to add the length
					// of the begin delimiter to it so it doesn't get
					// included when we parse the string
					$start += strlen($begindelim);
				}
				
				$count++;
			} while ($count <= $occur);
			
			// if start is false, we didn't find it, so we should not parse anything
			if ($start !== false) {
				// if $end is nothing, set the end of the parsing to the length of the content
				$end = (bool)false;
				if (strlen($enddelim)) {
					// find the end delimiter
					$end = strpos($content, $enddelim, $start);
				}
				// if enddelim was not found or not provided set the end to the length of the content
				if ($end === false) {
					$end = strlen($content);
				}
				
				// now we have the start and end, parse it out
				$parsedContent = substr($content, $start, $end - $start);
			}
		}
		
		return $parsedContent;
	}
}
?>