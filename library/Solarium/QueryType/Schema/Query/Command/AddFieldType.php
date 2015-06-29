<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 *
 * @copyright Copyright 2011 Bas de Nooijer <solarium@raspberry.nl>
 * @license http://github.com/basdenooijer/solarium/raw/master/COPYING
 * @link http://www.solarium-project.org/
 */

/**
 * @namespace
 */
namespace Solarium\QueryType\Schema\Query\Command;


use Solarium\Core\ArrayableInterface;
use Solarium\QueryType\Schema\Query\FieldType\FieldType;
use Solarium\QueryType\Schema\Query\FieldType\FieldTypeInterface;
use Solarium\QueryType\Schema\Query\Query as SchemaQuery;

/**
 * Class AddFieldType
 * @author Beno!t POLASZEK
 */
class AddFieldType extends Command implements ArrayableInterface {

    /**
     * @var FieldTypeInterface[]
     */
    protected $fieldTypes = array();

    /**
     * Returns command type, for use in adapters
     *
     * @return string
     */
    public function getType() {
        return SchemaQuery::COMMAND_ADD_FIELD_TYPE;
    }

    /**
     * @return FieldTypeInterface[]
     */
    public function getFieldTypes() {
        return $this->fieldTypes;
    }

    /**
     * @param FieldTypeInterface[] $fieldTypes
     * @return $this - Provides Fluent Interface
     */
    public function setFieldTypes(array $fieldTypes) {
        $this->fieldTypes = array();
        $this->addFieldTypes($fieldTypes);
        return $this;
    }

    /**
     * @param FieldTypeInterface $fieldType
     * @return $this
     */
    public function addFieldType(FieldTypeInterface $fieldType) {
        $this->fieldTypes[] = $fieldType;
        return $this;
    }

    /**
     * @param FieldTypeInterface[] $fieldTypes
     * @return $this - Provides Fluent Interface
     */
    public function addFieldTypes(array $fieldTypes) {
        foreach ($fieldTypes AS $fieldType)
            $this->addFieldType($fieldType);
        return $this;
    }

    /**
     * @param null $name
     * @param null $class
     * @return FieldType
     */
    public function createFieldType($name = null, $class = null) {
        $fieldType = new FieldType($name, $class);
        $this->addFieldType($fieldType);
        return $fieldType;
    }

    /**
     * @return array
     */
    public function castAsArray() {
        return array_values(array_map(function (FieldTypeInterface $fieldType) {
            return $fieldType->castAsArray();
        }, $this->getFieldTypes()));
    }

}