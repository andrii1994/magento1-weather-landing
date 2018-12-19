<?php

/**
 * Created by PhpStorm.
 * User: as
 * Date: 12/10/18
 * Time: 9:47 PM
 */
class Weather_Landing_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Route for weather landing page
     */
    const WEATHER_LANDING_PAGE_ROUTE = 'landing/view';

    /**
     * @return string
     */
    public function getLandingUrl()
    {
        return $this->_getUrl(self::WEATHER_LANDING_PAGE_ROUTE);
    }

    /**
     * @return string
     */
    public function getTopLinksCheckoutUrl()
    {
        return $this->_getUrl('checkout', array('_secure' => true));
    }
}