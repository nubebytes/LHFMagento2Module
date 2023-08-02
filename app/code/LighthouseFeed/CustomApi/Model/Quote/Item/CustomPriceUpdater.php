<?php
namespace LighthouseFeed\CustomApi\Model\Quote\Item;

use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Item;

class CustomPriceUpdater
{
    /**
     * Find the cart item for a product by SKU.
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param string $sku
     * @return \Magento\Quote\Model\Quote\Item|null
     */
    public function findCartItemBySku(Quote $quote, $sku)
    {
        foreach ($quote->getAllVisibleItems() as $item) {
            if ($item->getProduct()->getSku() === $sku) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Update the custom price for a cart item.
     *
     * @param \Magento\Quote\Model\Quote\Item $cartItem
     * @param float $customPrice
     * @return void
     */
    public function updateCustomPrice(Item $cartItem, $customPrice)
    {
        $cartItem->setCustomPrice($customPrice);
        $cartItem->setOriginalCustomPrice($customPrice);
        $cartItem->getProduct()->setIsSuperMode(true);
    }
}
