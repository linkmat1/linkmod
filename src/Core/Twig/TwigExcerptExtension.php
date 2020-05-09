<?php


namespace App\Core\Twig;

use Parsedown;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExcerptExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('excerpt', [$this, 'excerpt']),

        ];
    }
    /**
     * @param string|null $content
     * @param int $characterLimit
     * @return string
     */
    public function excerpt(?string $content, int $characterLimit = 135): string
    {
        if ($content === null) {
            return '';
        }
        if (mb_strlen($content) <= $characterLimit) {
            return $content;
        }
        $lastSpace = strpos($content, ' ', $characterLimit);
        if ($lastSpace === false) {
            return $content;
        }
        return substr($content, 0, $lastSpace) . '...';
    }
}
