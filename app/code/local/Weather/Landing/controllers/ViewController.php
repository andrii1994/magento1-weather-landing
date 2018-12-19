<?php

/**
 * Created by PhpStorm.
 * User: as
 * Date: 12/10/18
 * Time: 9:49 PM
 */
class Weather_Landing_ViewController extends Mage_Core_Controller_Front_Action
{
    /**
     * Weather landing view controller
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}