<?php

class GalleryController
{
    function index()
    {
        $photos = [];
        for ($i = 1; $i <= 15; $i++) {
            $photos[] = [
                'caption' => "Фото " . $i,
                'alt' => "Фото " . $i,
                'title' => "Фото " . $i,
                'src' => '/assets/img/' . $i . '.jpg',
                'thumb' => '/assets/img/' . $i . '_thumb.jpg',
            ];
        }
        include ROOT . 'app/views/gallery.php';
    }

}