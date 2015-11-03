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
 * JoomlaPassword helper
 */
class Yireo_JoomlaPassword_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * @return false|Mage_Core_Model_Abstract|Mage_Core_Model_Encryption
     */
    public function getEncryptor()
    {
        if ($this->_encryptor === null) {
            $this->_encryptor = Mage::getModel('joomlapassword/encryption');
        }

        if (empty($this->_encryptor)) {
            return parent::getEncryptor();
        }

        return $this->_encryptor;
    }
}
