<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Travel;

return array(
    'router' => array(
        'routes' => array(
            'travel' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/dia-diem-di-choi',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Travel\Controller',
                        'controller'    => 'travel',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                  'travel-province' => array(
                    'type' => 'Segment',
                    'options' => array(
                      'route' => '/[:category]',

                      'defaults' => array(
                        '__NAMESPACE__' => 'Travel\Controller',
                        'controller' => 'Travel\Controller\Category',
                        'action' => 'index',
                      ),
                      'constraints' => array(
                        'category'     => '[a-zA-Z0-9_-]*',
                      ),
                    ),
                  ),
                  'travel-detail' => array(
                    'type' => 'Segment',
                    'options' => array(
                      'route' => '/[:category]/[:slug]',

                      'defaults' => array(
                        '__NAMESPACE__' => 'Travel\Controller',
                        'controller' => 'Travel\Controller\Category',
                        'action' => 'detail',
                      ),
                      'constraints' => array(
                        'category'     => '[a-zA-Z0-9_-]*',
                        'slug'     => '[a-zA-Z0-9_-]*',
                      ),
                    ),
                  ),
                  
                  'popup-view' => array(
                    'type' => 'Segment',
                    'options' => array(
                      'route' => '/view',

                      'defaults' => array(
                        '__NAMESPACE__' => 'Travel\Controller',
                        'controller' => 'Travel\Controller\Category',
                        'action' => 'view',
                      ),
                    ),
                  ),
                  
                  'popup-map' => array(
                    'type' => 'Segment',
                    'options' => array(
                      'route' => '/view-map',

                      'defaults' => array(
                        '__NAMESPACE__' => 'Travel\Controller',
                        'controller' => 'Travel\Controller\Category',
                        'action' => 'map',
                      ),
                    ),
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
          'Travel\Controller\Travel' => Controller\TravelController::class,
          'Travel\Controller\Category' => Controller\CategoryController::class
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'searchTravel'        => 'Travel\Block\searchTravel',
//          'footerTravel'        => 'Travel\Block\footerTravel',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/travel'           => __DIR__ . '/../view/layout/layout.phtml',
            'travel/index/index' => __DIR__ . '/../view/travel/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/popup-view'           => __DIR__ . '/../view/travel/category/view.phtml',
            'layout/popup-map'           => __DIR__ . '/../view/travel/category/map.phtml',
            'layout/detail-page'           => __DIR__ . '/../view/layout/detail.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy'
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
