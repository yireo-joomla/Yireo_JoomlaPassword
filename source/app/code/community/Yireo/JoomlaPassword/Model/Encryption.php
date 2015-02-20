<?php
/**
 * Yireo JoomlaPassword for Magento 
 *
 * @author Yireo
 * @copyright Copyright 2015
 * @license Open Source License
 * @link http://www.yireo.com
 */

/**
 * JoomlaPassword rewrite of default Encryption-class
 */
class Yireo_JoomlaPassword_Model_Encryption extends Mage_Core_Model_Encryption
{
    /**
     * Validate hash against hashing method (with or without salt)
     *
     * @param string $password
     * @param string $hash
     * @return bool
     * @throws Exception
     */
    public function validateHash($password, $hash)
    {
        // Explode the hash
        $hashArr = explode(':', $hash);

        // Joomla PHPass hashes
		if (strpos($hash, '$P$') === 0) {
            include_once BP.'lib/JoomlaPassword/PasswordHash.php';
            if(class_exists('PasswordHash')) {
                $phpass = new PasswordHash(10, true);
	    		return $phpass->CheckPassword($password, $hash);
            }

        // Native PHP password hashing
		} elseif ($hash[0] == '$' && function_exists('password_verify')) {
            return password_verify($password, $hash);

        // SHA256 (unsupported)
        } elseif (substr($hash, 0, 8) == '{SHA256}') {
            return false; 
        }

        // Regular hashing
        switch (count($hashArr)) {
            case 1:
                // Original MD5 hashes
                if(strlen($hash) == 32) {
                    return $this->hash($password) === $hash;
                }

            case 2:

                // Original Magento hashing
                $rt = $this->hash($hashArr[1] . $password) === $hashArr[0];

                // Joomla hashing
                if($rt == false) $rt = $this->hash($password.$hashArr[1]) === $hashArr[0];

                // Joomla reverse hashing
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
