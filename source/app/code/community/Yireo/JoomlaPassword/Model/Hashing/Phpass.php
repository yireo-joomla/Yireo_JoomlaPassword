<?php
/**
 * Yireo JoomlaPassword for Magento
 *
 * @author Yireo
 * @copyright Copyright 2015
 * @license Open Source License
 * @link https://www.yireo.com
 */

/**
 * Class Yireo_JoomlaPassword_Model_Hashing_Phpass
 */
class Yireo_JoomlaPassword_Model_Hashing_Phpass implements Yireo_JoomlaPassword_Model_Hashing_Interface
{
    /**
     * Yireo_JoomlaPassword_Model_Hashing_Phpass constructor.
     */
    public function __construct()
    {
        include_once BP . '/lib/JoomlaPassword/PasswordHash.php';
    }

    /**
     * @param $hash
     *
     * @return bool
     */
    public function allowHash($hash)
    {
        if (strpos($hash, '$P$') === 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param $password
     * @param $salt
     *
     * @return string
     */
    public function getHash($password, $salt = null)
    {
        if (class_exists('PasswordHash')) {
            $phpass = new PasswordHash(10, true);
            return $phpass->HashPassword($password);
        }
        
        return false;
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function validate($password, $hash)
    {
        if (class_exists('PasswordHash')) {
            $phpass = new PasswordHash(10, true);
            return $phpass->CheckPassword($password, $hash);
        }

        return false;
    }
}
