<?php
/*
 * This file is part of Xblog.
 * This file defines variables to config your blog.
 * Rendered in admin/settings.blade.php
 * Support type:
 *   1. text
 *   2. textarea
 *   3. radio
 *   4. number
 *   5. others
 */
return [
    [
        'name' => 'google_analytics',
        'type' => 'radio',
        'default' => 'false',
        'values' => [
            'true' => '启用谷歌分析',
            'false' => '禁用谷歌分析',
        ],
    ],
    [
        'name' => 'enable_mail_notification',
        'type' => 'radio',
        'default' => 'false',
        'values' => [
            'true' => '启用邮件通知',
            'false' => '禁用邮件通知',
        ],
    ],
    [
        'name' => 'comment_type',
        'type' => 'radio',
        'default' => 'raw',
        'values' => [
            'none' => '关闭评(不显示)',
            'raw' => '自带评论',
            'disqus' => 'Disqus',
        ],
    ],
    [
        'name' => 'allow_comment',
        'type' => 'radio',
        'default' => 'true',
        'values' => [
            'true' => '允许评论',
            'false' => '禁止评论(仍会显示已有评论)',
        ],
    ],
    [
        'name' => 'enable_hot_posts',
        'type' => 'radio',
        'default' => 'false',
        'values' => [
            'true' => '启用热门文章',
            'false' => '禁用热门文章',
        ],
    ],
    [
        'name' => 'open_pay',
        'type' => 'radio',
        'default' => 'false',
        'values' => [
            'true' => '开启赞赏',
            'false' => '关闭赞赏',
        ],
    ],
    [
        'name' => 'google_trace_id',
        'label' => '跟踪ID',
        'placeholder' => '谷歌跟踪ID'
    ],
    [
        'name' => 'author',
        'label' => '作者',
    ],
    [
        'name' => 'description',
        'label' => '描述',
    ],
    [
        'name' => 'avatar',
        'label' => '头像',
    ],
    [
        'name' => 'disqus_shortname',
        'label' => 'Disqus ID',
    ],
    [
        'name' => 'github_username',
        'label' => 'Github用户名',
    ],
    [
        'name' => 'site_title',
        'label' => '标题',
    ],
    [
        'name' => 'site_keywords',
        'label' => '关键字',
        "placeholder" => "网站关键字"
    ],
    [
        'name' => 'site_description',
        'label' => '网站描述',
    ],
    [
        'name' => 'page_size',
        'label' => '每页数量',
        'default' => 7,
        "type" => "number"
    ],
    [
        'name' => 'hot_posts_count',
        'label' => '热门文章数量',
        'default' => 5,
        "type" => "number"
    ],
    [
        'name' => 'profile_image',
        'label' => '简介图片',
    ],
    [
        'name' => 'header_bg_image',
        'label' => 'Header背景图片',
    ],
    [
        'name' => 'admin_sidebar_bg_image',
        'label' => 'Dashboard背景图片',
    ],
    [
        'name' => 'home_bg_images',
        'label' => 'Home背景图片',
        "type" => "textarea",
        "placeholder" => "可以多个, 一行一个"
    ],
    [
        'name' => 'pay_description',
        'label' => '赞赏描述',
        'default' => '写的不错，赞助一下主机费'
    ],
    [
        'name' => 'zhifubao_pay_image_url',
        'label' => '支付宝支付二维码',
    ],
    [
        'name' => 'wechat_pay_image_url',
        'label' => '微信支付二维码',
    ],
];