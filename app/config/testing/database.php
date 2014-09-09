<?php

return array(
    'default'   => 'sqlite',

    'connections' => array(
        'sqlite'   => array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ),
        'reportes' => array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        )
    ),

);