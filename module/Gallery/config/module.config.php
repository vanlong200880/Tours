<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Gallery;

return array(
    'router' => array(
        'routes' => array(
            'gallery' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/thu-vien-anh',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gallery\Controller',
                        'controller' => 'Gallery\Controller\Gallery',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                ),
            ),
            'gallery-category' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/thu-vien-anh/[:category][/trang-:page]',
                'defaults' => array(
                  '__NAMESPACE__' => 'Gallery\Controller',
                  'controller' => 'Gallery\Controller\Gallery',
                  'action' => 'category',
                ),
                'constraints' => array(
                  'category'     => '[a-zA-Z0-9_-]*'
                ),
              ),
            ),
            
            'gallery-detail' => array (
              'type' => 'Zend\Mvc\Router\Http\Regex',
              'options' => array (
                'regex' => '/thu-vien-anh/(?<slug>[a-zA-Z0-9-]+)-pr-(?<id>[0-9]+)?(\.(?<format>(html)))?',
                  'defaults' => array(
                    '__NAMESPACE__' => 'Gallery\Controller',
                    'controller' => 'Gallery\Controller\Gallery',
                    'action' => 'detail',
                    'format' => 'html',
                  ),
                  'spec' => '/thu-vien-anh/%slug%-pr-%id%.%format%'
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
          'Gallery\Controller\Gallery' => Controller\GalleryController::class,
//          'Tour\Controller\Category' => Controller\CategoryController::class
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
            'layout/gallery'           => __DIR__ . '/../view/layout/layout.phtml',
            'gallery/index/index' => __DIR__ . '/../view/diary/index/index.phtml',
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
