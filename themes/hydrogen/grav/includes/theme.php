<?php
namespace Grav\Theme;

use Gantry\Framework\Theme as GantryTheme;

class Hydrogen extends GantryTheme
{
    /**
     * @var GantryTheme
     */
    protected $gantryTheme;

    /**
     * @var string
     */
    public $layout;

    /**
     * @return array
     */
    public static function getSubscribedEvents() {
        return [
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ];
    }

    /**
     * Initialize nucleus layout engine.
     */
    public function onTwigInitialized()
    {
        $env = $this->grav['twig'];
        $this->extendTwig($env->twig(), $env->loader());
    }

    /**
     * Load current layout.
     */
    public function onTwigSiteVariables()
    {
        $twig = $this->grav['twig'];
        $twig->twig_vars = $this->getContext($twig->twig_vars);
    }
}
