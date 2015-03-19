<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 23.04.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

class Divante_PersonalReceipt_Model_Carrier_Method extends Mage_Shipping_Model_Carrier_Abstract
{
    protected $_code = 'divante_personalreceipt';
    protected $_isFixed = true;

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {

        if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');

        $methods = explode('|', Mage::getStoreConfig('carriers/'.$this->_code.'/name'));

        $counter = 0;

        foreach($methods as $name) {
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier('divante_personalreceipt');
            $method->setCarrierTitle(Mage::getStoreConfig('carriers/'.$this->_code.'/title'));
            $method->setMethod($counter++);
            $method->setMethodTitle($name);
            $method->setPrice(0);
            $method->setCost(0);
            $result->append($method);
        }


        return $result;
    }

    public function getAllowedMethods()
    {
        return array($this->_code => Mage::getStoreConfig('carriers/'.$this->_code.'/name'));
    }
}