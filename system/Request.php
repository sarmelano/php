<?php
//filter data
class Request {

    public  static function getUrl(): string {

        $url = $_SERVER['REQUEST_URI'];

        if(str_contains($url, '?'))  { //если после url знак ?(есть еще что то) , то обрезаем от 0 до позиции ?
            $url = substr($url, 0, strpos($url, '?'));
        }

        return $url;
    }

    public  static function getMethod(): string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function get(string $key, string $mode = 'string')
    {
        $data = [];
        if (self::getMethod() == 'get') {
            $data = $_GET;
        } elseif (self::getMethod() == 'post') {
            $data = $_POST;
        }

        $value = $data[$key] ?? null;

        if (isset($value)) {
            if($mode == 'int') {
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            } else {
                $value = filter_var($value, FILTER_SANITIZE_ADD_SLASHES);
            }

           // $value = htmlspecialchars($value);
            $value = strip_tags($value);
        }

        return $value;
    }

    public static function getReferer(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '';
    }
}