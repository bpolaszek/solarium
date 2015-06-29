<?php
/** 
 * AddField.php
 * Generated by PhpStorm - 06/2015
 * Project solarium
 * @author Beno!t POLASZEK
**/

namespace Solarium\QueryType\Schema\Query\Command;

use Solarium\Core\ArrayableInterface;
use Solarium\Exception\RuntimeException;
use Solarium\QueryType\Schema\Query\Field\CopyField;
use Solarium\QueryType\Schema\Query\Query as SchemaQuery;


class AddCopyField extends Command implements ArrayableInterface {

    /**
     * @var CopyField[]
     */
    protected $fields = array();

    /**
     * Returns command type, for use in adapters
     *
     * @return string
     */
    public function getType() {
        return SchemaQuery::COMMAND_ADD_COPY_FIELD;
    }

    /**
     * @return CopyField[]
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param CopyField[] $fields
     * @return $this - Provides Fluent Interface
     */
    public function setFields(array $fields) {
        $this->fields = array();
        $this->addFields($fields);
        return $this;
    }

    /**
     * @param CopyField[] $fields
     * @return $this - Provides Fluent Interface
     */
    public function addFields(array $fields) {
        foreach ($fields AS $field)
            is_array($field) ? $this->createField($field) : $this->addField($field);
        return $this;
    }

    /**
     * @param CopyField $field
     * @return $this
     */
    public function addField(CopyField $field) {
        if (!array_key_exists((string) $field, $this->getFields()))
            $this->fields[(string) $field] = $field;
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function createField(array $attributes = array()) {
        if (!array_key_exists('source', $attributes))
            throw new RuntimeException("A copyField must have a source attribute.");
        if (!array_key_exists('dest', $attributes))
            throw new RuntimeException("A copyField must have a dest attribute.");
        return $this->addField(new CopyField($attributes['source'], $attributes['dest'], isset($attributes['maxChars']) ? $attributes['maxChars'] : null));
    }

    /**
     * @return array
     */
    public function castAsArray() {
        return array_values(array_map(function (CopyField $copyField) {
            return $copyField->castAsArray();
        }, $this->getFields()));
    }

}