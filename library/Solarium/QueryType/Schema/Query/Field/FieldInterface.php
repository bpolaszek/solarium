<?php
/** 
 * FieldInterface.php
 * Generated by PhpStorm - 06/2015
 * Project solarium
 * @author Beno!t POLASZEK
**/

namespace Solarium\QueryType\Schema\Query\Field;


use Solarium\Core\ArrayableInterface;
use Solarium\Core\StringableInterface;

interface FieldInterface extends ArrayableInterface, StringableInterface {

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array());

    public function getName();
}