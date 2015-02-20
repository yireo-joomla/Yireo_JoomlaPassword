<?php
/**
 * Yireo JoomlaPassword for Magento 
 *
 * @author Yireo
 * @copyright Copyright 2014
 * @license Open Source License
 * @link http://www.yireo.com
 */

/**
 * JoomlaPassword rewrite of default Encryption-class
 */
class Yireo_JoomlaPassword_Model_Encryption extends Mage_Core_Model_Encryption
{
    public function validateHash($password, $hash)
    {
        $hashArr = explode(':', $hash);
        switch (count($hashArr)) {
            case 1:
                return $this->hash($password) === $hash;
            case 2:
                $rt = $this->hash($hashArr[1] . $password) === $hashArr[0];
                if($rt == false) $rt = $this->hash($password.$hashArr[1]) === $hashArr[0];
                if($rt == false) $rt = $this->hash($password.$hashArr[0]) === $hashArr[1];
                return $rt;
        }
        Mage::throwException('Invalid hash.');
    }

    /**
     * Generate a [salted] hash.
     *
     * $salt can be:
     * false - a random will be generated
     * integer - a random with specified length will be generated
     * string
     *
     * @param string $password
     * @param mixed $salt
     * @return string
     */
    public function getHash($password, $salt = false)
    {
        $this->setHelper(Mage::helper('joomlapassword'));
        return parent::getHash($password, $salt);
    }
}
