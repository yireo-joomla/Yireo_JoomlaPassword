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
 * JoomlaPassword rewrite of default Encryption-class
 */
class Yireo_JoomlaPassword_Model_Encryption extends Mage_Core_Model_Encryption
{
    /**
     * Validate hash against hashing method (with or without salt)
     *
     * @param string $password
     * @param string $hash
     *
     * @return bool
     * @throws Exception
     */
    public function validateHash($password, $hash)
    {
        $hashingObjects = Mage::getModel('joomlapassword/hashing')->getHashingObjects();

        foreach ($hashingObjects as $hashingObject) {
            /** @var $hashingObject Yireo_JoomlaPassword_Model_Hashing_Interface */
            if ($hashingObject->allowHash($hash) == false) {
                continue;
            }

            if ($hashingObject->validate($password, $hash)) {
                return true;
            }
        }

        return parent::validateHash($password, $hash);
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
     *
     * @return string
     */
    public function getHash($password, $salt = false)
    {
        $this->setHelper(Mage::helper('joomlapassword'));
        
        $hashingClasses = Mage::getModel('joomlapassword/hashing')->getHashingClasses();
        $hashingObjects = Mage::getModel('joomlapassword/hashing')->getHashingObjects();

        if (!in_array($salt, $hashingClasses)) {
            return parent::getHash($password, $salt);
        }

        foreach ($hashingObjects as $hashingObject) {
            /** @var $hashingObject Yireo_JoomlaPassword_Model_Hashing_Interface */
            $hash = $hashingObject->getHash($password);

            if (!empty($hash)) {
                return $hash;
            }
            
            // Note: This does not work properly for validating hashes, because of one-way-algorithms
        }
    }
}
