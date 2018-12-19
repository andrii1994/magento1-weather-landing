<?php
/**
 * Created by PhpStorm.
 * User: as
 * Date: 12/14/18
 * Time: 12:05 AM
 */

class Weather_Landing_AjaxController extends Mage_Core_Controller_Front_Action
{
    /**
     * @return $this
     * @throws Mage_Core_Model_Store_Exception
     */
    public function staticPageViewAction()
    {
        $identifier = $this->getRequest()->getParam('id');
        if (empty($identifier)) {
            $this->getResponse()->setBody('<h1>Empty page identifier</h1>');
            return $this;
        }
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page')->setStoreId(Mage::app()->getStore()->getId())
            ->load($identifier, 'identifier');
        if (!$page || !$page->getId()) {
            $this->getResponse()->setBody('<h1>Page with given identifier not exists</h1>');
            return $this;
        }
        /* @var $helper Mage_Cms_Helper_Data */
        $helper = Mage::helper('cms');
        $processor = $helper->getPageTemplateProcessor();
        $html = $processor->filter($page->getContent());
        $this->getResponse()->setBody($html);
        return $this;
    }
}