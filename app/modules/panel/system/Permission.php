<?php
$permission = array(
    '*' => array(
        '*' => array(
            'allow' => false,
            'redirect' => url('panel','login')
        ),
        'moder' => array(
            'allow' => true
        ),
        'admin' => array(
            'allow' => true
        )
    ),

    'login' => array(
        '*' => array(
            'allow' => false,
            'redirect' => url('panel')
        ),
        'user' => array(
            'allow' => true,
        ),
        'guest' => array(
            'allow' => true,
        )
    ),

    'restore_password' => array(
        '*' => array(
            'allow' => false,
            'redirect' => url('panel')
        ),
        'user' => array(
            'allow' => true,
        ),
        'guest' => array(
            'allow' => true,
        )
    ),

    'restore_process' => array(
        '*' => array(
            'allow' => false,
            'redirect' => url('panel')
        ),
        'user' => array(
            'allow' => true,
        ),
        'guest' => array(
            'allow' => true,
        )
    ),
);

/* End of file */