<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Video;

return array(
    'router' => array(
        'routes' => array(
            'video' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/video',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Video\Controller',
                        'controller'    => 'video',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
//                  'default' => array(
//                      'type'    => 'Segment',
//                      'options' => array(
//                          'route'    => '/[:controller[/:action]]',
//                          'constraints' => array(
//                              'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                              'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                          ),
//                          'defaults' => array(
//                          ),
//                      ),
//                  ),
                  'video-category' => array(
                    'type' => 'Segment',
      //              'priority' => 9001,
                    'options' => array(
                      'route' => '/[:category]',
                      'defaults' => array(
                        '__NAMESPACE__' => 'Video\Controller',
                        'controller' => 'Video\Controller\Video',
                        'action' => 'category'
                      ),
                      'constraints' => array(
                        'category'     => '[a-zA-Z0-9_-]*',
                      ),
                    ),
                  ),
                  'video-detail' => array(
                    'type' => 'Segment',
      //              'priority' => 9001,
                    'options' => array(
                      'route' => '/[:category][/:id]',
                      'defaults' => array(
                        '__NAMESPACE__' => 'Video\Controller',
                        'controller' => 'Video\Controller\Video',
                        'action' => 'detail',
                      ),
                      'constraints' => array(
                        'category'     => '[a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
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
          'Video\Controller\Video' => Controller\VideoController::class,
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
            'layout/video'           => __DIR__ . '/../view/layout/layout.phtml',
            'video/index/index' => __DIR__ . '/../view/video/index/index.phtml',
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
