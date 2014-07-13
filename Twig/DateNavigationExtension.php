<?php

namespace Jb\Bundle\DateNavigationBundle\Twig;

use Symfony\Component\DependencyInjection\Container;

/**
 * Description of DateNavigationExtension
 *
 * @author jobou
 */
class DateNavigationExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\Container
     */
    private $container;

    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * Constructor
     *
     * @param \Jb\Bundle\DateNavigationBundle\DateNavigationProvider $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Store environment to use template
     *
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Register function
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'date_navigation',
                array(
                    $this,
                    'renderDateNavigation'
                ),
                array(
                    'is_safe' => array('html')
                )
            ),
        );
    }

    /**
     * Render the date navigation html
     *
     * @param array $page
     * @param string $template
     *
     * @return string
     */
    public function renderDateNavigation($page, $template = 'date_navigation.html')
    {
        return $this->environment->render($template, array(
            'dates_posts' => $this->container->get('jb_sculpin.date_navigation.data_provider')->provideData(),
            'page' => $page,
            'permalink_factory' => $this->container->get('jb_sculpin.date_navigation.permalink_factory'),
            'current_date' => new \DateTime()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jb_date_navigation';
    }
}
