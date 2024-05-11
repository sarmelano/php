<?php

class NewsPost extends PlantPost {

    public function getBody(): string {
        return "<i>{$this->getTitle()}</i>:{$this->getContent()}";
    }

}