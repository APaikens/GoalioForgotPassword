<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'goalioforgotpassword' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'zfc-user/user/login' => __DIR__ . '/../view/zfc-user/user/login.phtml',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'goalioforgotpassword_forgot' => 'GoalioForgotPassword\Factory\Controller\ForgotControllerFactory',
        ),
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'child_routes' => array(
                    // Segment (was Literal) so the optional [/:language] bracket syntax
                    // is supported - a consuming project's own Db-user module (e.g.
                    // DiviUser) loads after this one, so it can still override these
                    // same keys further if it needs a narrower language set.
                    'forgotpassword' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:language]/forgot-password',
                            'constraints' => array(
                                'language' => 'lv|en|ru|lt|ee',
                            ),
                            'defaults' => array(
                                'controller' => 'goalioforgotpassword_forgot',
                                'action'     => 'forgot',
                            ),
                        ),
                    ),
                    'resetpassword' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:language]/reset-password/:userId/:token',
                            'defaults' => array(
                                'controller' => 'goalioforgotpassword_forgot',
                                'action'     => 'reset',
                            ),
                            'constraints' => array(
                                'language' => 'lv|en|ru|lt|ee',
                                'userId'  => '[A-Fa-f0-9]+',
                                'token' => '[A-F0-9]+',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
