<?php

declare(strict_types=1);

namespace AllTokens;

final class AllTokens
{
    public static function getAllTokens()
    {
        $tokenMap = self::getTokenConstants();

        foreach (self::getTemplates() as $template) {
            foreach (@\token_get_all($template) as $token) {
                if (!\is_array($token)) {
                    continue;
                }
                $tokenName = \token_name($token[0]);
                if (!isset($tokenMap[$tokenName])) {
                    continue;
                }

                yield $token;
                unset($tokenMap[$tokenName]);
            }
        }
    }

    private static function getTokenConstants()
    {
        return \array_filter(
            \get_defined_constants(true)['tokenizer'],
            static function ($constant) {
                return \strpos($constant, 'T_') === 0;
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    private static function getTemplates()
    {
        $contents = [
            \sprintf('<?php ;%s;', \chr(12)), // T_BAD_CHARACTER
        ];

        foreach (
            [
                5 => __DIR__ . '/../template/main.php',
                7 => __DIR__ . '/../template/php7.php',
            ] as $phpVersion => $template
        ) {
            if (PHP_MAJOR_VERSION >= $phpVersion) {
                $contents[] = file_get_contents($template);
            }
        }

        return $contents;
    }
}
