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
                    'post-tour' => array(
                      'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/post-travel/[:action]',
                            'defaults' => array(
                              '__NAMESPACE__' => 'User\Controller',
                              'controller'    => 'Tours',
                              'action'        => 'add',
                            ),
                            'constraints' => array(
                              'action' => '[a-zA-Z0-9_-]+'
                            ),
                        ),
                    ),
                    
                    
                    
                    
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
                    
                  'user-my-travel' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/my-travel',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'MyTravel',
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
                    
                  'user-travel-admin' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/travel-admin',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Travel',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  
                  'user-changepassword' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/change-password',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'User',
                            'action'        => 'changePassword',
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
                  
                  'user-blog' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/blog',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Blog',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  'user-blog-create' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/blog-create',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Blog',
                            'action'        => 'post',
                          ),
                      ),
                  ),
                  
                  'user-blog-comment' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/blog-comment',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Blog',
                            'action'        => 'comment',
                          ),
                      ),
                  ),
                  'user-taste' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/taste',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Taste',
                            'action'        => 'index',
                          ),
                      ),
                  ),

                  'user-taste-create' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/taste/create',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Taste',
                            'action'        => 'create',
                          ),
                      ),
                  ),
                  'user-taste-create-menu-group' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/taste/create-menu-group',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Taste',
                            'action'        => 'createMenuGroup',
                          ),
                      ),
                  ),
                  'user-taste-create-menu' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/taste/create-menu/:id',
                          'constraints' => array(
                            'id'     => '[0-9]+',
                          ),
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Taste',
                            'action'        => 'createMenu',
                          ),
                      ),
                  ),
                  
                  // hotel
                  'user-hotel' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/hotel',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Hotel',
                            'action'        => 'index',
                          ),
                      ),
                  ),
                  'user-hotel-create' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/create-hotel',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Hotel',
                            'action'        => 'create',
                          ),
                      ),
                  ),
                  'user-hotel-create-room' => array(
                      'type'    => 'Segment',
                      'options' => array(
                          'route'    => '/create-room/:id',
                          'defaults' => array(
                            '__NAMESPACE__' => 'User\Controller',
                            'controller'    => 'Hotel',
                            'action'        => 'create-room',
                          ),
                      ),
                  ),
                  // 
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
          'User\Controller\Blog' => Controller\BlogController::class,
          'User\Controller\Taste' => Controller\TasteController::class,
          'User\Controller\Hotel' => Controller\HotelController::class,
          'User\Controller\Travel' => Controller\TravelController::class,
          'User\Controller\MyTravel' => Controller\MyTravelController::class,
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'timeline'        => 'User\Block\timeline',
          'menuTravel'        => 'User\Block\menuTravel',
          'menuProfile'        => 'User\Block\menuProfile',
          'menuBlog'        => 'User\Block\menuBlog',
          'menuTaste'        => 'User\Block\menuTaste',
          'menuHotel'        => 'User\Block\menuHotel',
          'userHeader'        => 'User\Block\userHeader',
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
             'layout/mytravel'           => __DIR__ . '/../view/layout/layout-my-travel.phtml',
            'layout/user-admin'           => __DIR__ . '/../view/layout/layout-user-admin.phtml',
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/login'           => __DIR__ . '/../view/layout/login.phtml',
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
