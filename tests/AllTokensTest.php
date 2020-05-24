<?php

/*
 * This file is part of all-token.
 *
 * (c) 2020 Kuba Werłos
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
    public function testTokenIsInCollection($constantValue)
    {
        $tokens = \array_filter(
            \iterator_to_array(AllTokens::getAllTokens()),
            static function ($token) use ($constantValue) {
                return $token[0] === $constantValue;
            }
        );

        self::assertCount(1, $tokens);
    }

    public static function provideTokenIsInCollectionCases()
    {
        $tokens = \get_defined_constants(true)['tokenizer'];

        foreach ($tokens as $constantName => $constantValue) {
            if (\strpos($constantName, 'T_') !== 0) {
                continue;
            }

            if ($constantName === 'T_BAD_CHARACTER' && PHP_MAJOR_VERSION < 7) { // not used before PHP 7
                continue;
            }

            if ($constantName === 'T_CHARACTER') { // not used anymore
                continue;
            }

            yield $constantName => [$constantValue];
        }
    }
}
