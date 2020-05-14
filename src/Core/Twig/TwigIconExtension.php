<?php

namespace App\Core\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/*
 * Cree une Extension pour permettre de mettre des icon dans le Menu et autre place importante du site !! en SVG
 */
class TwigIconExtension extends AbstractExtension {

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions():array
    {
        return [
            new TwigFunction('icon', [$this, 'svgIcon'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Cree une SVG
     * @param string $name
     * @return string
     */
    public function svgIcon(string $name): string
    {
        return <<<HTML
        <svg class="icon icon-{$name}">
          <use xlink:href="/sprite.svg#{$name}"></use>
        </svg>
        HTML;
    }
}