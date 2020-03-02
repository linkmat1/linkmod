<?php

namespace App\Twig\CacheExtension;

use App\Twig\Cache\CacheNode;
use Twig\Node\Expression\AbstractExpression;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

class CacheTokenParser extends AbstractTokenParser
{
    /**
     * @param Token $token
     * @return CacheNode<AbstractExpression>
     *
     * @throws \Twig\Error\SyntaxError
     */
    public function parse(Token $token): CacheNode
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $key = $this->parser->getExpressionParser()->parseExpression();
        $key->setAttribute('always_defined', true);
        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideCacheEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);

        return new CacheNode($key, $body, $lineno, $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag(): string
    {
        return 'cache';
    }

    public function decideCacheEnd(Token $token): bool
    {
        return $token->test('endcache');
    }
}
