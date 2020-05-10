<?php


namespace App\Core\Twig;

use Parsedown;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigMarkdownExtension extends AbstractExtension
{



    public function getFilters(): array
    {
        return [
            new TwigFilter('markdown', [$this, 'markdown'], ['is_safe' => ['html']]),
            new TwigFilter('markdown_excerpt', [$this, 'markdownExcerpt'], ['is_safe' => ['html']]),
            new TwigFilter('markdown_untrusted', [$this, 'markdownUntrusted'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Convertit le contenu markdown en HTML
     */
    public function markdown(?string $content): string
    {
        if ($content === null) {
            return '';
        }
        $content = (new Parsedown())->text($content);
        $content = preg_replace(
            '/<p><a href\="(http|https):\/\/www.youtube.com\/watch\?v=([^\""]+)">[^<]*<\/a><\/p>/',
            '<div class="video"><div class="ratio"><iframe width="560" height="315" src="//www.youtube-nocookie.com/embed/$2" frameborder="0" allowfullscreen=""></iframe></div></div>',
            $content);

        return $content;
    }

    public function markdownExcerpt(?string $content, int $characterLimit = 135): string
    {
        return $this->excerpt(strip_tags($this->markdown($content)), $characterLimit);
    }

    public function markdownUntrusted(?string $content): string
    {
        return (new Parsedown())->setSafeMode(true)->text($content);
    }

}
