<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tour;

return array(
    'router' => array(
        'routes' => array(
            'tour' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/tours-du-lich',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Tour\Controller',
                        'controller'    => 'Tour',
                        'action'        => 'index',
                    ),
                ),
            ),
          
          'tour-category' => array(
            'type' => 'Segment',
            'options' => array(
              'route' => '/tours-du-lich/[:nation][/:province][/:district][/trang-:page]',
              'defaults' => array(
                '__NAMESPACE__' => 'Tour\Controller',
                'controller' => 'Tour\Controller\Tour',
                'action' => 'index',
              ),
              'constraints' => array(
                'nation'     => '[a-zA-Z0-9_-]*',
                'province'     => '[a-zA-Z0-9_-]*',
                'district'     => '[a-zA-Z0-9_-]*',
                'page'     	=> '[0-9]+',
              ),
            ),
          ),
          
          'tour-view' => array(
            'type' => 'Segment',
            'options' => array(
              'route' => '/tour-view',

              'defaults' => array(
                '__NAMESPACE__' => 'Tour\Controller',
                'controller' => 'Tour\Controller\Category',
                'action' => 'view',
              ),
            ),
          ),
          
          'tour-detail' => array(
            'type' => 'Segment',
            'options' => array(
              'route' => '/tour-detail',

              'defaults' => array(
                '__NAMESPACE__' => 'Tour\Controller',
                'controller' => 'Tour\Controller\Tour',
                'action' => 'detail',
              ),
            ),
          ),
          
          'tour-page-detail' => array (
              'type' => 'Zend\Mvc\Router\Http\Regex',
              'options' => array (
                'regex' => '/tours-du-lich/(?<slug>[a-zA-Z0-9-]+)-pr-(?<id>[0-9]+)?(\.(?<format>(html)))?',
                  'defaults' => array(
                    '__NAMESPACE__' => 'Tour\Controller',
                    'controller' => 'Tour\Controller\Tour',
                    'action' => 'pageDetail',
                    'format' => 'html',
                  ),
                  'spec' => '/tours-du-lich/%slug%-pr-%id%.%format%'
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
          'Tour\Controller\Tour' => Controller\TourController::class,
          'Tour\Controller\Category' => Controller\CategoryController::class
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'searchTour'        => 'Tour\Block\searchTour',
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
            'layout/tour'           => __DIR__ . '/../view/layout/layout.phtml',
            'tour/index/index' => __DIR__ . '/../view/tour/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/view'           => __DIR__ . '/../view/tour/category/view.phtml',
            'layout/detail'           => __DIR__ . '/../view/tour/tour/detail.phtml',
            'layout/tour-page-detail'           => __DIR__ . '/../view/layout/tour-detail.phtml',
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
