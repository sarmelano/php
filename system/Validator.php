<?php

trait Validator
{
    public array $errors = [];
    //=============================================================
    private function required(string $fieldName):bool
    {
        $value = Request::get($fieldName);
        if (!$value) {
            return false;
        }
        return true;
    }

    private function email(string $fieldName):bool
    {
        if (filter_var(Request::get($fieldName), FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    private function confirm(string $fieldName):bool
    {
        $fieldValue = Request::get($fieldName);
        $confirmValue = Request::get($fieldName . '_confirm');
        if ($fieldValue != $confirmValue) {
            return false;
        }
        return true;
    }
    //=============================================================
    public function validate(array $rules)
    {
        if(!$rules) {
            return;
        }

        foreach ($rules as $field => $rulesArray) {
            foreach ($rulesArray as $rule) {

                if ($rule == 'required') {
                    if (!$this->required($field)) {
                        $this->errors[$field][] = $this->getErrorMessage('required', $field);
                    }
                }

                if ($rule == 'email') {
                    if (!$this->email($field)) {
                        $this->errors[$field][] = $this->getErrorMessage('email', $field);
                    }
                }

                if ($rule == 'confirm') {
                    if (!$this->confirm($field)) {
                        $this->errors[$field][] = $this->getErrorMessage('confirm', $field);
                    }
                }
            }
        }

        $this->checkErrors();
    }

    private function checkErrors(): void
    {
        if ($this->errors) {
            Session::set('validationErrors', $this->errors);
            Response::redirect(Request::getReferer());
        }
    }

    private function errorsMessages(): array
    {
        return [
            'required' => 'The %s field is required',
            'email' => 'The %s field must be a valid email address',
            'confirm' => 'The %s field must be confirmed',
        ];
    }

    private function getErrorMessage(string $key, string $fieldName): string
    {
        $messages = $this->errorsMessages();
        if (!isset($messages[$key])) {
            throw new Exception('Invalid error message');
        }

        return sprintf($messages[$key], $fieldName);
    }
}