<?php
namespace App\Providers;

class Validator
{
    private $errors = [];
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->name = $name ? ucfirst($name) : ucfirst($key);
        return $this;
    }

    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name is required";
        }
        return $this;
    }

    public function min($length)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name must be equal or greater than $length characters";
        }
        return $this;
    }

    public function max($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name must be equal or less than $length characters";
        }
        return $this;
    }

    public function int()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
            $this->errors[$this->key] = "$this->name must be an integer";
        }
        return $this;
    }

    public function float()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_FLOAT)) {
            $this->errors[$this->key] = "$this->name must be a decimal";
        }
        return $this;
    }

    public function email()
    {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key] = "Invalid $this->name format";
        }
        return $this;
    }

    public function isSuccess()
    {
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->isSuccess() ? [] : $this->errors;
    }
}