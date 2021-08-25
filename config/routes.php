<?php

return array(

    /* -- NEWS CONTROLLER -- */

    //  News by Id
    'news/article/([0-9]+)$' => 'news/article/$1',


    //  News by Categories
    'news/group-([a-z0-9-_]+)/([a-zA-Z0-9-_]+)/page-([0-9]+)$' => 'news/category/$1/$2/$3',
    'news/group-([a-z0-9-_]+)/([a-zA-Z0-9-_]+)$' => 'news/category/$1/$2',

    //  News by Groups
    'news/group-([a-z0-9-_]+)/page-([0-9]+)$' => 'news/group/$1/$2',
    'news/group-([a-z0-9-_]+)$' => 'news/group/$1',

    //  News without any filters
    'news/page-([0-9]+)$' => 'news/index/$1',
    'news$' => 'news/index',


    'about$' => 'about/index',

    'rules$' => 'rules/index'
);
