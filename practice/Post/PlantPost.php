<?php

class PlantPost {
    public function __construct(private string $title, private string $content) {
    }
//Setters
    public function setTitle(string $title):void {
        $this->validate($title);
        $this->title = $title;
    }
    public function setContent(string $content):void {
        $this->validate($content);
        $this->content = $content;
    }
//Getters
    public function getTitle(): string {
        return $this->title;
    }
    public function getContent(): string {
        return $this->content;
    }
//Validation

    public function validate(string $string) {
        if (strlen($string) < 5) {
            throw new Exception('Invalid Post');
        }
    }
}