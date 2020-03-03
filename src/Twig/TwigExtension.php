<?php


namespace App\Twig;


use Parsedown;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('icon', [$this, 'svgIcon'], ['is_safe' => ['html']])
        ];
    }
    public function getFilters()
    {
        return [
            new TwigFilter('excerpt', [$this, 'excerpt']),
            new TwigFilter('markdown', [$this, 'markdown'], ['is_safe' => ['html']]),
            new TwigFilter('markdown_excerpt', [$this, 'markdownExcerpt'], ['is_safe' => ['html']])
        ];

    }

    /**
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

    /**
     * @param string|null $content
     * @param int $characterLimit
     * @return string
     */
    public function excerpt(?string $content, int $characterLimit =  135):string
    {
        if( $content === null){
            return '';

        }
        if (mb_strlen($content) <= $characterLimit){
            return $content;
        }
        $lastSpace = strrpos($content, ' ', $characterLimit);
        if($lastSpace === false)
        {
            return $content;
        }
        return substr($content, 0, $lastSpace) . "...";
    }


    /**
     * @param string|null $content
     * @return string
     */
    public function markdown(?string $content): string
    {
        if ($content === null) {
            return '';
        }
        $content = (new Parsedown())->text($content);
        $content = preg_replace(
            '/<p><a href\="(http|https):\/\/www.youtube.com\/watch\?v=([^\""]+)">[^<]*<\/a><\/p>/',
            '<div class="ratio"><iframe width="560" height="315" src="//www.youtube-nocookie.com/embed/$2" frameborder="0" allowfullscreen=""></iframe></div>',
            $content);

        return $content;
    }

    public function markdownExcerpt(?string $content, int $characterLimit = 135): string
    {
        return $this->excerpt(strip_tags($this->markdown($content)), $characterLimit);
    }

}