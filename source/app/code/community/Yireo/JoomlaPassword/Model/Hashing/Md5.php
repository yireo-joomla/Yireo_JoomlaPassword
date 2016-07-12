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
 * Class Yireo_JoomlaPassword_Model_Hashing_Md5
 */
class Yireo_JoomlaPassword_Model_Hashing_Md5 implements Yireo_JoomlaPassword_Model_Hashing_Interface
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
     * @param $salt
     *
     * @return string
     */
    public function getHash($password, $salt = null)
    {
        return md5($password);
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function validate($password, $hash)
    {
        return ($this->getHash($password) === $hash);
    }
}
