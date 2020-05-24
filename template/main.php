<?php

declare(strict_types = 1);
enddeclare;

include 'path1';
include_once 'path2';
require 'path3';
require_once 'path4';

namespace Foo;

interface I {}

trait T1 { public function t() {}}
trait T2 { public function t() {}}

/* Comment */
abstract class A {}

/** PHPDoc */
final class C extends A implements I {
    use T1, T2 {
        T1::t insteadof T2;
    }

    var $var;

    public function f(callable $c) {
        yield from $this->func();
    }
    private function func() {
        yield 1;
    }

    public function f1() {
        return self::f();
    }
    protected function f2() {
        return static::f();
    }
    private static function f() {
        return null;
    }
}

$x or $y;
$x xor $y;
$x and $y;
$x += $y;
$x -= $y;
$x *= $y;
$x /= $y;
$x .= $y;
$x %= $y;
$x &= $y;
$x |= $y;
$x ^= $y;
$x <<= $y;
$x >>= $y;
$x **= $y;
$x ??= $y;
$x ?? $y;
$x || $y;
$x && $y;
$x == $y;
$x != $y;
$x === $y;
$x !== $y;
$x <=> $y;
$x <= $y;
$x >= $y;
$x << $y;
$x >> $y;
$x ** $y;

const CONSTANT = 'c';
global $g;

$a = array();
b(...$a);
$f = fn($x) => $x--;
list($l1, $l2) = [1, 1.5];

$x = (array) $x;
$x = (bool) $x;
$x = (int) $x;
$x = (double) $x;
$x = (object) $x;
$x = (string) $x;
(unset) $x;

try {
    throw new Exception();
} catch(\Throwable $e) {
    return clone $e;
} finally {
    print('message');
}

empty($x);
isset($x);
unset($x);

echo __CLASS__;
echo __DIR__;
echo __FILE__;
echo __FUNCTION__;
echo __LINE__;
echo __METHOD__;
echo __NAMESPACE__;
echo __TRAIT__;

echo "Values {$x}, ${x} and $a[0].";

echo <<<TEXT
    text
TEXT;

for ($i = 0; $i < 3; $i++):
    continue;
endfor;

foreach ([1,2,3] as $item):
endforeach;

if ($x instanceof X):
elseif (false):
else:
endif;

switch ($x):
    case 1: echo 1; break;
    default: echo 'default';
endswitch;

while (false):
endwhile;

do {} while(false);

goto: hell;

?><?= $x;

eval('echo 1;');
exit;
__halt_compiler();
