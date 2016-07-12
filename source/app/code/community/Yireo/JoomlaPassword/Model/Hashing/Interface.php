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
 * Class Yireo_JoomlaPassword_Model_Hashing_Interface
 */
interface Yireo_JoomlaPassword_Model_Hashing_Interface
{
    /**
     * @param $hash
     *
     * @return bool
     */
    public function allowHash($hash);

    /**
     * @param $password
     * @param $salt
     *
     * @return string
     */
    public function getHash($password, $salt = null);

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function validate($password, $hash);
}
