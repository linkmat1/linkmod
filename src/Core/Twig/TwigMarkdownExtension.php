<?php


namespace App\Core\Twig;

use Parsedown;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigMarkdownExtension extends AbstractExtension
{


    /**
     * @var TwigExcerptExtension
     */
    private TwigExcerptExtension $ext;

    public function __construct(TwigExcerptExtension $ext)
    {
        $this->ext = $ext;
    }

    public function getFilters()
    {
        return [

            new TwigFilter('markdown', [$this, 'markdown'], ['is_safe' => ['html']]),
            new TwigFilter('markdown_excerpt', [$this, 'markdownExcerpt'], ['is_safe' => ['html']])
        ];
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
            $content
        );

        return $content;
    }

    public function markdownExcerpt(?string $content, int $characterLimit = 135): string
    {
        return $this->ext->excerpt(strip_tags($this->markdown($content)), $characterLimit);
    }
}
