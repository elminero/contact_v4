<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii_contact',
            'username' => 'ian',
            'password' => 'super1964',
            'charset' => 'utf8',
        ],

        'authManager' => [
            'class' => '\yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

 //       'user' => [
  //          'identityClass' => 'app\models\User',
  //          'enableAutoLogin' => true,
  //      ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
