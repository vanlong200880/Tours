<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Backend;

return array(
    'router' => array(
        'routes' => array(
            'backend' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Backend\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                  'category' => array(
                    'type' => 'Segment',
                    'options' => array(
                      'route' => '[/:controller][/:action][/:id][/page/:page][/type/:type][/sort/:sort][/order/:order][/textSearch/:textSearch]',

                      'defaults' => array(
                      ),
                      'constraints' => array(
                        'controller'    => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
								'page'          => '[0-9]+',
								'id'            => '[0-9]+',

								'type'          => '[0-9]+',
								'sort'          => '[a-zA-Z][a-zA-Z0-9_-]*',
								'order'         => 'asc|desc',
								'textSearch'    => '.+',
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
          'Backend\Controller\Index' => Controller\IndexController::class,
          'Backend\Controller\Category' => Controller\CategoryController::class,
          'Backend\Controller\Nation' => Controller\NationController::class,
          'Backend\Controller\Province' => Controller\ProvinceController::class,
          'Backend\Controller\District' => Controller\DistrictController::class,
          'Backend\Controller\Ward' => Controller\WardController::class,
          'Backend\Controller\Travel' => Controller\TravelController::class,
          'Backend\Controller\Tour' => Controller\TourController::class,
          'Backend\Controller\Diary' => Controller\DiaryController::class,
          'Backend\Controller\Taste' => Controller\TasteController::class,
          'Backend\Controller\Video' => Controller\VideoController::class,
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'backendHeader'        => 'Backend\Block\backendHeader',
          'backendMenu'        => 'Backend\Block\backendMenu',
          'backendFooter'        => 'Backend\Block\backendFooter',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/backend'           => __DIR__ . '/../view/layout/layout.phtml',
//            'hotel/index/index' => __DIR__ . '/../view/hotel/index/index.phtml',
//            'error/404'               => __DIR__ . '/../view/error/404.phtml',
//            'error/index'             => __DIR__ . '/../view/error/index.phtml'
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
