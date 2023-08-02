<?php
namespace LighthouseFeed\CustomApi\Model;

use LighthouseFeed\CustomApi\Api\CustomPriceManagementInterface;
use Magento\Quote\Model\GuestCart\GuestCartRepository;
use Magento\Quote\Model\QuoteRepository;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomPriceManagement implements CustomPriceManagementInterface
{
    protected $guestCartRepository;
    protected $quoteRepository;
    protected $customPriceUpdater;

    public function __construct(
        GuestCartRepository $guestCartRepository,
        QuoteRepository $quoteRepository,
        \LighthouseFeed\CustomApi\Model\Quote\Item\CustomPriceUpdater $customPriceUpdater
    ) {
        $this->guestCartRepository = $guestCartRepository;
        $this->quoteRepository = $quoteRepository;
        $this->customPriceUpdater = $customPriceUpdater;
    }

    /**
     * Set custom price for a specific product in the cart identified by the cart token.
     *
     * @param string $cartToken
     * @param string $sku
     * @param float $customPrice
     * @return bool
     */
    public function setCustomPrice($cartToken, $sku, $customPrice)
    {
        try {
            $quote = $this->guestCartRepository->get($cartToken);

            if ($quote) {
                $quoteItem = $this->customPriceUpdater->findCartItemBySku($quote, $sku);

                if ($quoteItem) {
                    $this->customPriceUpdater->updateCustomPrice($quoteItem, $customPrice);
                    $this->quoteRepository->save($quote);
                    return true;
                }
            }
        } catch (NoSuchEntityException $e) {
            // Handle exception (quote not found)
        }

        return false;
    }
}
