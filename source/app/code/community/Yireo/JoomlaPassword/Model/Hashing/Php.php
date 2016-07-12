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
 * Class Yireo_JoomlaPassword_Model_Hashing_Php
 */
class Yireo_JoomlaPassword_Model_Hashing_Php implements Yireo_JoomlaPassword_Model_Hashing_Interface
{
    /**
     * @param $hash
     *
     * @return bool
     */
    public function allowHash($hash)
    {
        if ($hash[0] == '$' && function_exists('password_verify')) {
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
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function validate($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
