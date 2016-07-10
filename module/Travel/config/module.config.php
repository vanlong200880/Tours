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
                    'route'    => '/dia-diem-phuot',
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
//          'headerTravel'        => 'Travel\Block\headerTravel',
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
