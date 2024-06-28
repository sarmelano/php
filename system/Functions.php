<?php

function view(string $path, array $variables =[]): true {
    $view = new View();
    return $view->render($path, $variables);
}

/**
 * for validation errors
 * @param string $key
 * @return void
 */
function showError(string $key): void
{
    if($errors = Session::get('validationErrors')){
        $fieldErrors = $errors[$key] ?? null;
        if (isset($fieldErrors)) {
            /*================================*/
            $html = '<div style="color:red">';
            foreach ($fieldErrors as $fieldError) {
                $html .= "- $fieldError; <br>";
            }
            $html .= '</div>';
            /*================================*/
            echo $html;
            Session::removeValidationError($key);
        }
    }
}

function getMessage(string $key): string|null
{
    $messages = Session::get($key);
    Session::remove($key);
    return $messages;
}