<?php

namespace Network\Hash;
abstract class RandomKey {
  public function generateKey($length){
    $token = "";
    $codeAlphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwx
    yzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789
    8Kgn0F1KaiNLpGQTu8Jm9rkI3oxbMXOLd1d4OTeOzV404ara
ajeO9C27oLwu8bqPc4hT9HDew4J86MfY0KbEKoGzAxUa1BHj
nFcY9i3vSJLL7L6w6VFfQqF8Z498f5vEqL4Nvlt90i9O8JyA
z8zvRuqUAJn14pDVsibcO26H9m3TQz7MP75mvGYoZhUb2rgP
HXLIjDE4ht526N6KvDUbbTGMvtAYAroVzQhvUJAs4oEshIPI
Fn6M7jKSra3ckqM18Eav2Jrpb5XBYeaKJnL2Wto3t0Zbi5k2
UHbNOY5OWh0IXOkN3gQzMWnK6YZtK8XIlm7KEiaj3Ck9UMoG
98jjAcn0Ott9SIn1VaZssm3As8QopWfd2Wyt70X3r5x4dbb8
6kVtvvOEj42Nq7rPkXKXHvwc0UItWyJ53dfCwrTuM85GrrxP
1V2pkYLryTQU9j4nil0O2wvQ19jl6TGw64yDxtzRiF7iYEJQ
7uE95tvH0jZMe0uNw1ciUp7bnmQW4zmW61Ye0m31fm7iU19y
r3WK0wf9IvVM6d2kAvUo8mSNpRM79l6GKelDFw84R4A0LwnE
bYi4f2NBoTTkGzORob5fu17ha4rSwmxl6iAZ2ztHkV9MKwlc
GwDn0KIH34Y07W5c05vsSO5kttetATqo89hqsOR9lov3CajL
06lL8D70B15QOSkRWlwbPN1EESg7lvZgstz9IKZVtavOakUt
n4JAIvQAly2ZRJJg36ORsVP2X6q2HprM6WAsXu35W47Wo0q5
358xeGGYa9IaBTUfYqkZDRJE6Dlf51367onX08ml22xRohBK
viSuX0D9BPin6bqKk6DyBFowbzH1E1r6A4iVw0rkuJCPdPQG
W5pyawTOMCFCN6KVfYXBKeXMhY1NXeyKXEhyEIGYS8LZr11D
pJKOIGR6as0q43XirldYdjgxtiRACG5PNJeE1YxNgGxQlChY
0K3v3UjfpcEIvJUM1oOfOy9ZsDv6rwcZDxUvfn0Q30eRjtTa
U6j01hev7j36RK3RZtQ2Rs1SWSTv6Us4EisfV5k21cfB20tZ
FG5ffPLwujB5VzidppApQgj4U1go5iy1u3bNetXMy1Iuio30
e0R7FJMVzEil2aDawNqsWVtUcfwBP5gqUqOa7GEdp8LYD2LO
5IwVsRU83pfz4LFDKKECo9wGSe2Yvs7n23vDG110R5HT3ERA
UqfZQlFZHfKs6p760ZVTuCx07auAWHkZFOeWBbWKpMXqzuw6
2um5JKa5TE7Kg64tQ4Sbd7n6892733bbVzRA17vRRglGdmEP
UIZw33NCHb55r9tFJynXW8WHxjqsWSlcnr4Ol87chYcHa4F9
U2sZfdTHTeq68Nt5S5M5N0XdFssC8Gwc4i4uM4d64K8KNC4y
2PLqvXqyNvfyMGBcU3bpEDgsp6mDfYXWU34AGZJIA3UeKBlR
u8VxB82BJVI0FS4IXU5akk5txZXOYwitr8ddBr6o12P6ABDV
WRUiFZViISEa9z1gVdCr5AAEJ3MBO506cWVa6jW50RRcukz2
eJ6Oi04jinlJhoRWVTkNOEp5E2WrxVZHQeWwYLOncVGx03b7
NerHyzw3zMI28ua8N509vPqf01px8llzIJ9ASxdz06dc1pt8
mobTZqggR173k73avsY94tvAUwrVBMI7e8S4iUUn1NFwOHVS
r7Kdh6HqRek53I06L1iqg52D792on02tak7VExhKZs0O8V5N
KcrvRIA8zXdmzNdyE1PIOJ1IsV10FGoxa0eKFhzjjUCGQIy4
D2emIkFYABYR7LvNjG0RBsf91rlS2Vmb5S49Umpy56D2NUwt
FO41hzMjZeOBCOc7rLqlCho5C280U6AHghhAi3VMVp2ck41b";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
    }

    return $token;
  }
  public function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}
}
