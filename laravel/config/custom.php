<?php

return [
    'route' => [
        'prefix_admin' => 'admin',
        'slider' => [
            'ctrl' => 'slider',
            'prefix' => 'slider',
            'view' => 'slider'
        ],
        'dashboard' => [
            'ctrl' => 'dashboard',
            'prefix' => 'dashboard',
            'view' => 'dashboard'
        ]
    ],
    'format' => [
        'longTime' => 'd/m/Y H:m:s',
        'shortTime' => 'd/m/Y'
    ],
    'enum' => [
        'ruleStatus' => [
            'active' => ['name' => 'Kích hoạt', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-warning'],
            'all' => ['name' => 'Tất cả', 'class' => 'btn-primary'],
            'unknown' => ['name' => 'Không xác định', 'class' => 'btn-danger']
        ],
        'searchSelection' => [
            'all' => ['name' => 'Tìm tất cả'],
            'id' => ['name' => 'Tìm theo id'],
            'name' => ['name' => 'Tìm theo tên'],
            'username' => ['name' => 'Tìm theo username'],
            'fullname' => ['name' => 'Tìm theo tên đầy đủ'],
            'email' => ['name' => 'Tìm theo email'],
            'description' => ['name' => 'Tìm theo mô tả'],
            'content' => ['name' => 'Tìm theo nội dung'],
            'link' => ['name' => 'Tìm theo link'],
        ],
        'selectionInModule' => [
            'default' => ['all'],
            'slider' => ['all', 'id', 'name', 'description', 'link']
        ],
        'ruleBtn' => [
            'edit'      => ['class' => 'btn-success',   'title' => 'Điều chỉnh',    'icon' => 'fa-pencil',  'route' => "/form"],
            'delete'    => ['class' => 'btn-delete btn-danger',    'title' => 'Xoá',           'icon' => 'fa-trash',   'route' => "/delete"],
            'info'      => ['class' => 'btn-info',      'title' => 'Thông tin',     'icon' => 'fa-info',    'route' => "/form"],
        ],
        'btnInArea' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete']
        ]
    ]
];
