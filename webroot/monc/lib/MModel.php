<?php


/**
 * Class MMode
 * 处理连接，保存，后台队列，以及自动生成方案
 */
abstract class MModel extends MComponent implements IteratorAggregate, ArrayAccess {

    private $_validators; // validators

    abstract public function attributeNames();

    public function rules() {
        return array ();
    }

    public function labels() {
        return array ();
    }

    public function label($attribute) {
        $labels = $this->labels();
        if (isset($labels[$attribute]))
            return $labels[$attribute];
        else
            return $this->generateAttributeLabel($attribute);
    }

    public function generateAttributeLabel($name) {
        return t(ucwords(trim(strtolower(str_replace(array ('-', '_', '.'), ' ',
            preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name))))));
    }

    public function getAttributes($names = null) {
        $values = array ();
        foreach ($this->attributeNames() as $name)
            $values[$name] = $this->$name;

        if (is_array($names)) {
            $values2 = array ();
            foreach ($names as $name)
                $values2[$name] = isset($values[$name]) ? $values[$name] : null;
            return $values2;
        } else
            return $values;
    }

    public function setAttributes($values) {
        if (!is_array($values))
            return $this;
        $attributes =
            array_flip($this->attributeNames());
        foreach ($values as $name => $value) {
            if (isset($attributes[$name]))
                $this->$name = $value;
        }
        return $this;
    }

    /**
     * Sets the attributes to be null.
     * @param array $names list of attributes to be set null. If this parameter is not given,
     * all attributes as specified by {@link attributeNames} will have their values unset.
     * @since 1.1.3
     */
    public function unsetAttributes($names = null) {
        if ($names === null)
            $names = $this->attributeNames();
        foreach ($names as $name)
            $this->$name = null;
    }

    public function getValidators($attribute = null) {
        if ($this->_validators === null)
            $this->_validators = $this->createValidators();

        $validators = array ();
        foreach ($this->_validators as $validator) {
            if ($attribute === null || in_array($attribute, $validator->attributes, true))
                $validators[] = $validator;
        }
        return $validators;
    }

    public function createValidators() {
        $validators = new MList();
        foreach ($this->rules() as $rule) {
            if (isset($rule[0], $rule[1])) // attributes, validator name
                $validators->add(CValidator::createValidator($rule[1], $this, $rule[0],
                    array_slice($rule, 2)));
            else
                throw new CException(Yii::t('yii',
                    '{class} has an invalid validation rule. The rule must specify attributes to be validated and the validator name.',
                    array ('{class}' => get_class($this))));
        }
        return $validators;
    }

    public function getValidatorList() {
        if ($this->_validators === null)
            $this->_validators = $this->createValidators();
        return $this->_validators;
    }

    public function validate($attributes = null, $clearErrors = true) {
        if ($clearErrors)
            $this->clearErrors();
        foreach ($this->getValidators() as $validator)
            $validator->validate($this, $attributes);
        return !$this->hasErrors();
    }

    public function getIterator() {
        $attributes = $this->getAttributes();
        return new CMapIterator($attributes);
    }

    public function offsetExists($offset) {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset) {
        return $this->$offset;
    }

    public function offsetSet($offset, $item) {
        $this->$offset = $item;
    }

    public function offsetUnset($offset) {
        unset($this->$offset);
    }
}
