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
 * Class Yireo_JoomlaPassword_Model_Hashing_Md5_Core
 */
class Yireo_JoomlaPassword_Model_Hashing_Md5_Core implements Yireo_JoomlaPassword_Model_Hashing_Interface
{
    /**
     * @param $hash
     *
     * @return bool
     */
    public function allowHash($hash)
    {
        if (strlen($hash) == 32) {
            return true;
        }

        return false;
    }
    
    /**
     * @param $password
     *
     * @return string
     */
    public function getHash($password, $salt = null)
    {
        return md5($salt . $password) . ':' . $salt;
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function validate($password, $hash)
    {
        $hashArr = explode(':', $hash);

        if (count($hashArr) != 2) {
            return false;
        }

        return md5($hashArr[1] . $password) === $hashArr[0];
    }
}
