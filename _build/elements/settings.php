<?php

return [
    'email_tpl' => [
        'xtype' => 'textfield',
        'value' => 'tpl.helpfulPageEmailTpl',
        'area' => 'helpfulpage_main',
    ],
    'email_subject' => [
        'xtype' => 'textfield',
        'value' => 'Новый отзыв с сайта [[++site_name]]',
        'area' => 'helpfulpage_main',
    ],
    'email_sender' => [
        'xtype' => 'textfield',
        'value' => '[[++emailsender]]',
        'area' => 'helpfulpage_main',
    ],
];