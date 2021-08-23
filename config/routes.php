<?php

return array(

    'news/group-([a-z0-9-_]+)/([a-z0-9-_]+)/page-([0-9]+)' => 'news/category/$1/$2/$3',
    'news/group-([a-z0-9-_]+)/([a-z0-9-_]+)' => 'news/category/$1/$2/$3',

    'news/group-([a-z0-9-_]+)/page-([0-9]+)' => 'news/group/$1',
    'news/group-([a-z0-9-_]+)' => 'news/group/$1',

    'news' => 'news/index',

    'about' => 'about/index',

    'rules' => 'rules/index'
);
