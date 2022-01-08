<?php
    return  [
        [
            'label' => 'Quản lý kết quả thi',
            'route' => 'dashboard.index',
            'icon' => 'mdi mdi-marker-check',
        ],[
            'label' => 'Quản lý sinh viên',
            'icon' => 'account-circle-outline',
            'tag'   => 'ui-basic',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'user',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'create.index',
                    'model' => 'user',
                ]
            ]
        ],[
            'label' => 'Quản lý giáo viên',
            'icon' => 'contact-mail-outline',
            'tag'   => 'form-elements',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'admin',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'create.index',
                    'model' => 'admin',
                ]
            ]
        ],[
            'label' => 'Quản lý lớp học',
            'icon' => 'floor-plan',
            'tag'   => 'charts',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'theme',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'create.index',
                    'model' => 'theme',
                ]
            ]
        ],[
            'label' => 'Quản lý câu hỏi',
            'icon' => 'comment-question-outline',
            'tag'   => 'tables',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'question',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'create.index',
                    'model' => 'question',
                ]
            ]
        ],[
            'label' => 'Quản lý đề thi',
            'icon' => 'card-text-outline',
            'tag'   => 'icons',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'subject',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'create.index',
                    'model' => 'subject',
                ]
            ]
        ],[
            'label' => 'Góp ý từ sinh viên',
            'icon' => 'comment-multiple-outline',
            'tag'   => 'feedbacks',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'listing.index',
                    'model' => 'idea'
                ]
            ]
        ],[
            'label' => 'Xếp hạng sinh viên',
            'route' => 'rank.index',
            'icon' => 'chart-line',
        ]
    ]

?>