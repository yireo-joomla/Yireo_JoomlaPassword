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
 * Class Yireo_JoomlaPassword_Model_Hashing
 */
class Yireo_JoomlaPassword_Model_Hashing
{
    /**
     * @var array
     */
    protected $hashingClasses = array(
        'phpass',
        'php',
        'sha',
        'md5',
        'md5/core',
        'md5/joomla',
        'md5/joomlareverse',
    );

    /**
     * @return array
     */
    public function getHashingClasses()
    {
        return $this->hashingClasses;
    }

    /**
     * @return array
     */
    public function getHashingObjects()
    {
        $hashingObjects = array();

        foreach ($this->hashingClasses as $hashingClass) {
            $hashingObject = $this->getHashingObject($hashingClass);
            $hashingObjects[] = $hashingObject;
        }

        return $hashingObjects;
    }

    /**
     * @param $hashingClass
     *
     * @return mixed
     * @throws Mage_Core_Exception
     */
    public function getHashingObject($hashingClass)
    {
        $hashingObject = Mage::getModel('joomlapassword/hashing_' . $hashingClass);

        if (!$hashingObject instanceof Yireo_JoomlaPassword_Model_Hashing_Interface) {
            Mage::throwException('Invalid hashing object: ' . $hashingClass);
        }

        return $hashingObject;
    }
}