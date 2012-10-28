<?php

/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
  /***************************************
 *         MAGENTO EDITION USAGE NOTICE *
 * *************************************** */
/* This package designed for Magento COMMUNITY edition
 * BelVG does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BelVG does not provide extension support in case of
 * incorrect edition usage.
  /***************************************
 *         DISCLAIMER   *
 * *************************************** */
/* Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
 * ****************************************************
 * @category   Belvg
 * @package    Belvg_Hhalloween
 * @author Pavel Novitsky <pavel@belvg.com>
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

/**
 * Halloween promotion helper
 */
class Belvg_Halloween_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Block position
     */
    const XML_PATH_HALLOWEEN_POSITION = 'halloween/settings/position';

    /**
     * Block title
     */
    const XML_PATH_HALLOWEEN_TITLE = 'halloween/settings/title';

    /**
     * List of selected SKUs
     */
    const XML_PATH_HALLOWEEN_SKUS = 'halloween/settings/products';

    /**
     * Module cache tag
     */
    const CACHE_TAG = 'belvg_halloween';

    /**
     * Separator for the selected SKUs
     *
     * @var string
     */
    protected $skus_separator = ',';

    /**
     * Block position
     *
     * @param mixed $store
     * @return string
     */
    public function getPosition($store = '')
    {
        return Mage::getStoreConfig(self::XML_PATH_HALLOWEEN_POSITION, $store);
    }

    /**
     * Get block title
     *
     * @param mixed $store
     * @return string
     */
    public function getTitle($store = '')
    {
        return Mage::getStoreConfig(self::XML_PATH_HALLOWEEN_TITLE, $store);
    }

    /**
     * Get array of selected SKUs
     *
     * @param mixed $store
     * @return array
     */
    public function getSkus($store = '')
    {
        // get SKUs from configuration
        $skus = Mage::getStoreConfig(self::XML_PATH_HALLOWEEN_SKUS, $store);
        // array of SKUs
        $skus_array = explode($this->skus_separator, $skus);
        $product_sku = NULL;
        // get current product (if any)
        if (Mage::registry('product')) {
            $product_sku = Mage::registry('product')->getSku();
        }

        // remove leading spaces from SKUs, remove current product from list
        foreach ($skus_array as $k => $v) {
            $skus_array[$k] = trim($v);
            if ($product_sku == $skus_array[$k]) {
                unset($skus_array[$k]);
            }
        }

        return $skus_array;
    }

    /**
     * Get cache tag
     *
     * @return string
     */
    public function getCacheTag()
    {
        return self::CACHE_TAG;
    }

}
