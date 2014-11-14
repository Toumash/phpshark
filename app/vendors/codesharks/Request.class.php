<?php
defined('R') or die('This file cannot be run as single');
/**
Passes all request data from the user
*/
class Request{
/**
* Target Class#method to execute
* @var string
*/ 
public $target;
/**
 * Contains parameters, different for each request type
 * @var array
 */
public $params;
/**
 * @var array
 */ 
public $hmvcRoute;

/**
 * Used only in the boostrap, first lines of framework
 */ 
public function __construct($target, $params){
  $this->target = $target;
  $this->params = $params;
}
/**
 * Used only for debugging the hops in the HMVC hierarchy
 */ 
public function nextHopInHierarchy($methodName){
  $this->hmvcRoute[] = $methodName;
}

}
?>