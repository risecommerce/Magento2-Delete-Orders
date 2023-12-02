<h3><a target="_blank" href="https://risecommerce.com/">Risecore Technologies Pvt. Ltd.</a></h3>
<a target="_blank" href="https://risecommerce.com/"><img width="100%" height="208" src="https://risecommerce.com/media/wysiwyg/logowithtext.png"></a>

##WhatsApp Chat Extension

<a href="https://risecommerce.com/magento2-delete-order.html"><img width="190" height="70" src="https://risecommerce.com/media/wysiwyg/risedownload.png"></a>


"Risecommerce_DeleteOrders" extension. This extension is designed for eCommerce stores, allowing users to delete test or ad-hoc orders, invoices, shipments, and credit memos. Additionally, it offers the convenience of deleting these elements either one-by-one or in bulk with a single click, specifically for orders with certain allowed statuses.

The extension is accessible in both the Order Detail Page and the Order Grid, making it more user-friendly and providing flexibility for managing and cleaning up orders.

If you have any questions about using or configuring this extension, you may want to refer to the documentation or support resources provided by Risecommerce. Additionally, if you have specific queries or issues, feel free to ask for assistance!

 <a target="_blank" href="https://demo.risecommerce.com/"> <img width="190" height="70" src="https://risecommerce.com/media/wysiwyg/frontend-demo.png"> </a>
 <a target="_blank" href="https://demo.risecommerce.com/admindemo"> <img width="190" height="70" src="https://risecommerce.com/media/wysiwyg/Backend-Demo.png"> </a>


##Support: 
version - 2.3.*,2.4.*

##How to install Extension

<h4>Method I:</h4>
<p>1. Download the archive file.</p>
<p>2. Unzip the file</p>
<p>3. Create a folder [Magento_Root]/app/code/Risecommerce/DeleteOrders</p>
<p>4. Drop/move the unzipped files to directory '[Magento_Root]/app/code/Risecommerce/DeleteOrders'</p>

<h4>Method II:</h4>

Using Composer

```
composer require risecommerce/magento-2-delete-orders-extension:1.0.1

```

<h4>Enable Extension:</h4>

```
 php bin/magento module:enable Risecommerce_DeleteOrders
 php bin/magento setup:upgrade
 php bin/magento cache:clean
 php bin/magento setup:static-content:deploy
 php bin/magento cache:flush
```

<h4>Disable Extension:</h4>

```
 php bin/magento module:disable Risecommerce_DeleteOrders
 php bin/magento setup:upgrade
 php bin/magento cache:clean
 php bin/magento setup:static-content:deploy
 php bin/magento cache:flush
```

 <h3>Configuration:</h3>
<img width="830" height="430" src="https://risecommerce.com/media/wysiwyg/DeleteConfiguration.png">


 <h3>Order Grid:</h3>
 <img width="830" height="430" src="https://risecommerce.com/media/wysiwyg/Delete1.png">

 <h3>Order Detail Page:</h3>
 <img width="830" height="430" src="https://risecommerce.com/media/wysiwyg/Delete2.png">
