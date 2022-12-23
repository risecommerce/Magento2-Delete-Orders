##Risecommerce Delete Orders Extension
Delete Orders extension allows eCommerce stores to delete all test or ad-hoc orders, invoices, shipments and credit memos either one-by-one or in bulk on a single click for allowed order statuses.

##Support: 
version - 2.3.x, 2.4.x

##How to install Extension

1. Download the archive file.
2. Unzip the files
3. Create a folder [Magento_Root]/app/code/Risecommerce/DeleteOrders
4. Drop/move the unzipped files to directory '[Magento_Root]/app/code/Risecommerce/DeleteOrders'

#Enable Extension:
- php bin/magento module:enable Risecommerce_DeleteOrders
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush

#Disable Extension:
- php bin/magento module:disable Risecommerce_DeleteOrders
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush
