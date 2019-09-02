<<?php
  class Login{
    public static function isLoggedIn{
      if (isset($_COOKIE['SNID'])) {
              if (DB::query('SELECT userid FROM asargtokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
                      $userid = DB::query('SELECT userid FROM asargtokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['userid'];
                      if (isset($_COOKIE['SNID_'])) {
                              return $userid;
                      } else {
                              $cstrong = True;
                              $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                              DB::query('INSERT INTO asargtokens VALUES (\'\', :token, :userid)', array(':token'=>sha1($token), ':userid'=>$userid));
                              DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                              setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                              setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                              return $userid;
                      }
              }
      }
    }
  }


?>
