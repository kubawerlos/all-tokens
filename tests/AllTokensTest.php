<?php

declare(strict_types=1);

namespace Tests;

use AllTokens\AllTokens;
use PHPUnit\Framework\TestCase;

/**
 * @covers \AllTokens\AllTokens
 *
 * @internal
 */
final class AllTokensTest extends TestCase
{
    /**
     * @dataProvider provideTokenIsInCollectionCases
     */
    public function testTokenIsInCollection($constantValue): void
    {
        $tokens = \array_filter(
            \iterator_to_array(AllTokens::getAllTokens()),
            static function ($token) use ($constantValue) {
                return $token[0] === $constantValue;
            }
        );

        self::assertCount(1, $tokens);
    }

    public static function provideTokenIsInCollectionCases(): iterable
    {
        $tokens = \get_defined_constants(true)['tokenizer'];

        foreach ($tokens as $constantName => $constantValue) {
            if (\strpos($constantName, 'T_') !== 0) {
                continue;
            }

            yield $constantName => [$constantValue];
        }
    }
}
