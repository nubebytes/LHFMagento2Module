<?php
namespace LighthouseFeed\CustomApi\Api;

interface CustomPriceManagementInterface
{
    /**
     * Set custom price for a specific product in the cart identified by the cart token.
     *
     * @param string $cartToken
     * @param string $sku
     * @param float $customPrice
     * @return bool
     */
    public function setCustomPrice($cartToken, $sku, $customPrice);
}