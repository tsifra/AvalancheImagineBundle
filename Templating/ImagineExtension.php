<?php

namespace Avalanche\Bundle\ImagineBundle\Templating;

use Avalanche\Bundle\ImagineBundle\Imagine\CachePathResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ImagineExtension extends AbstractExtension
{
    /**
     * @var Avalanche\Bundle\ImagineBundle\Imagine\CachePathResolver
     */
    private $cachePathResolver;

    /**
     * Constructs by setting $cachePathResolver
     *
     * @param Avalanche\Bundle\ImagineBundle\Imagine\CachePathResolver $cachePathResolver
     */
    public function __construct(CachePathResolver $cachePathResolver)
    {
        $this->cachePathResolver = $cachePathResolver;
    }

    /**
     * (non-PHPdoc)
     * @see Twig_Extension::getFilters()
     */
    public function getFilters(): array
    {
        return array(
            new TwigFilter('apply_filter', array($this, 'applyFilter')),
        );
    }

    /**
     * Gets cache path of an image to be filtered
     *
     * @param string $path
     * @param string $filter
     * @param boolean $absolute
     *
     * @return string
     */
    public function applyFilter($path, $filter, $absolute = false)
    {
        return $this->cachePathResolver->getBrowserPath($path, $filter, $absolute);
    }

    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'imagine';
    }
}
