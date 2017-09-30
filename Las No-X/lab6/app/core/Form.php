<?php

class Form
{
    protected $_form = [];
    protected $_errors = [];
    protected $_result = '';

    public function __construct($form, $validator)
    {
        $this->_form = $form;
        $this->_errors = $validator->errors();
        $this->_result = $validator->result();
    }

    public function success()
    {
        return $this->inProcess() && !$this->hasErrors();
    }

    public function inProcess()
    {
        return !empty($this->_form);
    }

    public function hasErrors()
    {
        return !empty($this->_errors);
    }

    public function result()
    {
        return $this->_result;
    }

    public function hint($field)
    {
        if (!empty($this->_errors[$field])) {
            $message = is_array($this->_errors[$field]) ? implode("\n", $this->_errors[$field]) : $this->_errors[$field];

            return sprintf('<div class="validation-message">%s</div>', $message);
        }

        return '';
    }

    public function selected($field, $value)
    {
        if (!empty($this->_form[$field]) && $this->_form[$field] == $value) {
            return 'selected';
        }

        return '';
    }

    public function checked($field, $value)
    {
        if (!empty($this->_form[$field]) && $this->_form[$field] == $value) {
            return 'checked';
        }

        return '';
    }

    public function value($field)
    {
        if (!empty($this->_form[$field])) {
            return sprintf('value="%s"', $this->_form[$field]);
        }

        return '';
    }

    public function val($field)
    {
        if (!empty($this->_form[$field])) {
            return $this->_form[$field];
        }

        return '';
    }

    public function state($field)
    {
        if ($this->inProcess()) {
            return !empty($this->_errors[$field]) ? 'has-error' : 'has-success';
        }

        return '';
    }

    public function error($field, $text) {
    	$this->_errors[$field] = $text;
    }

    public function clear() {
    	$this->_form = ['__success'];
		$this->_errors = [];
		$this->_result = '';
    }
}