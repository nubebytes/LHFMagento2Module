# Lighthousefeed-Customapi
Module to create a custom API call to change the custom prices of a cart To install on a Magento 2.X


To install in Magento2.x you must copy the entire "app" folder and its contents to the magento root folder. Then, with the command line, you need to run these commands in order:

- bin/magento module:enable LighthouseFeed_CustomApi
- bin/magento setup:upgrade
- bin/magento cache:flush

After doing this, the custom call to PUT will be enabled https:// /V1/guest-carts/:cartToken/updateCustomPrice to change the custom price of a cart quote in magento for a product attached to this
