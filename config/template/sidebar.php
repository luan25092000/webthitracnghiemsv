<?php
    return  [
        [
            'label' => 'Quản lý kết quả thi',
            'route' => 'admin.dashboard.index',
            'icon' => 'floor-plan',
        ],[
            'label' => 'Quản lý sinh viên',
            'icon' => 'account-circle-outline',
            'tag'   => 'ui-basic',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'student.index',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'student.create',
                ]
            ]
        ],[
            'label' => 'Quản lý giáo viên',
            'icon' => 'contact-mail',
            'tag'   => 'form-elements',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'teacher.index',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'teacher.create',
                ]
            ]
        ],[
            'label' => 'Quản lý chủ đề',
            'icon' => 'table',
            'tag'   => 'charts',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'theme.index',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'theme.create',
                ]
            ]
        ],[
            'label' => 'Quản lý câu hỏi',
            'icon' => 'comment-question-outline',
            'tag'   => 'tables',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'quest.index',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'quest.create',
                ]
            ]
        ],[
            'label' => 'Quản lý đề thi',
            'icon' => 'card-text-outline',
            'tag'   => 'icons',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'exam.index',
                ],
                [
                    'label' => 'Tạo mới',
                    'route' => 'exam.create',
                ]
            ]
        ],[
            'label' => 'Xếp hạng sinh viên',
            'icon' => 'chart-line',
            'tag'   => 'auth',
            'items' => [
                [
                    'label' => 'Danh sách',
                    'route' => 'rank.index',
                ],
            ]
        ]
    ]

?>