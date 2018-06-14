<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\Hash;

class Hash
{
  public static function make($string,$salt)
  {
    return hash('sha256',$string.$salt);
  }
  public static function salt($length)//generate a salt of a particular length
  {
     $characters = '
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
     ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  public static function unique()
  {
    return self::make(base64_encode(openssl_random_pseudo_bytes(50)));

  }


}
