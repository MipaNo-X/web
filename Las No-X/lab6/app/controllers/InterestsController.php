<?php

class InterestsController
{
    function index() {
        $list = [
            'type' => 'ul',
            'list_el' => [
                [
                    'href' => '#literature',
                    'text' => 'Литература',
                    'children' => [
                        'type' => 'ul',
                        'list_el' => [
                            [
                                'href' => '#loved_genres',
                                'text' => 'Любимые жанры'
                            ],
                            [
                                'href' => '#loved_authors',
                                'text' => 'Любимые авторы'
                            ]
                        ]
                    ]
                ],
                [
                    'href' => '#music',
                    'text' => 'Музыка',
                    'children' => [
                        'type' => 'ul',
                        'list_el' => [
                            [
                                'href' => '#loved_styles',
                                'text' => 'Любимые стили'
                            ],
                            [
                                'href' => '#loved_artistsgroups',
                                'text' => 'Любимые исполнители, группы'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        include ROOT.'app/views/interests.php';
    }

}