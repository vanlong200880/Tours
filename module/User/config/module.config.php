<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

return array(
    'router' => array(
        'routes' => array(
            'user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                  'post' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/post',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Tours',
                            'action'        => 'post',
                          ),
                      ),
                  ),
                  
                  'user-photos' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/album',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Album',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  
                  'user-profile' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/profile',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'User',
                            'action'        => 'profile',
                          ),
                      ),
                  ),
                  
                  'list-tours' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/list-tours',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Tours',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  'tours-order' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/tours-order',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Tours',
                            'action'        => 'order',
                          ),
                      ),
                  ),
                  'tours-comment' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/tours-comment',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Tours',
                            'action'        => 'comment',
                          ),
                      ),
                  ),
                  'user-mail' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/mail',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Mail',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  'user-order' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/order-history',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'User',
                            'action'        => 'order',
                          ),
                      ),
                  ),
                  'user-order-view' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/order-history/detail/:orderId[/]',
                          'constraints' => array(
                            'orderId'     => '[0-9]+',
                          ),
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'User',
                            'action'        => 'viewOrder',
                          ),
                      ),
                  ),
//                  'tour-category' => array(
//                    'type' => 'Segment',
//      //              'priority' => 9001,
//                    'options' => array(
//                      'route' => '/[:category][.html]',
//
//                      'defaults' => array(
//                        '__NAMESPACE__' => 'Tour\Controller',
//                        'controller' => 'Tour\Controller\Category',
//                        'action' => 'index',
//                        'category' => '[a-zA-Z0-9_-]*'
//                      ),
//                      'constraints' => array(
//                        'category'     => '[a-zA-Z0-9_-]*',
//                      ),
//                    ),
//                  ),
                ),
            ),
            'login' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/dang-nhap',

                'defaults' => array(
                  '__NAMESPACE__' => 'User\Controller',
                  'controller' => 'User\Controller\Public',
                  'action' => 'login'
                ),
              ),
            ),
            'register' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/dang-ky',

                'defaults' => array(
                  '__NAMESPACE__' => 'User\Controller',
                  'controller' => 'User\Controller\Public',
                  'action' => 'register'
                ),
              ),
            ),
            'forgot' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/quen-mat-khau',

                'defaults' => array(
                  '__NAMESPACE__' => 'User\Controller',
                  'controller' => 'User\Controller\Public',
                  'action' => 'forgot'
                ),
              ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
          'User\Controller\User' => Controller\UserController::class,
          'User\Controller\Public' => Controller\PublicController::class,
          'User\Controller\Album' => Controller\AlbumController::class,
          'User\Controller\Tours' => Controller\ToursController::class,
          'User\Controller\Mail' => Controller\MailController::class,
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'timeline'        => 'User\Block\timeline',
          'menuTours'        => 'User\Block\menuTours',
          'menuProfile'        => 'User\Block\menuProfile',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/user'           => __DIR__ . '/../view/layout/layout.phtml',
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
