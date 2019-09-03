<?php
// include('variables.php');

class LoginClass
{
    public static function isLoggedIn()
    {
        if (isset($_COOKIE['SNID']))
        {
            $home_path='arijits';
            $token_table_name='asargtokens';
            if (DataBase::query('SELECT userid FROM '.$token_table_name.' WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID']))))
            {
                $userid = DataBase::query('SELECT userid FROM '.$token_table_name.' WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['userid'];
                if(isset($_COOKIE['SNID_']))
                {
                    return $userid;
                }
                else
                {
                    $crypto_strong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $crypto_strong));
                    DataBase::query('INSERT INTO asargtokens VALUES (\'\', :token, :userid)',
                                    array(':token'=>sha1($token), ':userid'=>$userid));
                    DataBase::query('DELETE FROM login_tokens WHERE token=:token',
                                    array(':token'=>sha1($_COOKIE['SNID'])));
                    // Check to change if we have to change the path of the cookie
                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
                    setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
                    return $userid;
                }
            }
        }
    }
}
?>
