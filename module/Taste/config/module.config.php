<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Taste;

return array(
    'router' => array(
        'routes' => array(
            'taste' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/diem-an-uong',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Taste\Controller',
                        'controller'    => 'Taste',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                ),
            ),
            'taste-category' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/diem-an-uong/[:category][/:nation][/:province][/:district][/trang-:page]',
                'defaults' => array(
                  '__NAMESPACE__' => 'Taste\Controller',
                  'controller' => 'Taste\Controller\Taste',
                  'action' => 'index',
                ),
                'constraints' => array(
                  'category'     => '[a-zA-Z0-9_-]*',
                  'nation'     => '[a-zA-Z0-9_-]*',
                  'province'     => '[a-zA-Z0-9_-]*',
                  'district'     => '[a-zA-Z0-9_-]*',
                  'page'     	=> '[0-9]+',
                ),
              ),
            ),
          
            'taste-detail' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/taste-detail',

                'defaults' => array(
                  '__NAMESPACE__' => 'Taste\Controller',
                  'controller' => 'Taste\Controller\Taste',
                  'action' => 'detail',
                ),
              ),
            ),
          
            'taste-order' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/taste-order',

                'defaults' => array(
                  '__NAMESPACE__' => 'Taste\Controller',
                  'controller' => 'Taste\Controller\Taste',
                  'action' => 'order',
                ),
              ),
            ),
          
            'taste-page-detail' => array (
              'type' => 'Zend\Mvc\Router\Http\Regex',
              'options' => array (
                'regex' => '/diem-an-uong/(?<slug>[a-zA-Z0-9-]+)-pr-(?<id>[0-9]+)?(\.(?<format>(html)))?',
                  'defaults' => array(
                    '__NAMESPACE__' => 'Taste\Controller',
                    'controller' => 'Taste\Controller\Taste',
                    'action' => 'pageDetail',
                    'format' => 'html',
                  ),
                  'spec' => '/diem-an-uong/%slug%-pr-%id%.%format%'
              )
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
          'Taste\Controller\Taste' => Controller\TasteController::class,
//          'Tour\Controller\Category' => Controller\CategoryController::class
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'searchTaste'        => 'Taste\Block\searchTaste',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/taste'           => __DIR__ . '/../view/layout/layout.phtml',
            'taste/index/index' => __DIR__ . '/../view/taste/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/taste-detail'           => __DIR__ . '/../view/taste/taste/detail.phtml',
          'layout/taste-order'           => __DIR__ . '/../view/taste/taste/order.phtml',
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
