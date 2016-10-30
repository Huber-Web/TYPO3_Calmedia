.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================

Target group: **Administrators**


.. _admin-installation:

Installation
------------

* Install the extension with the extension manager
* Create a folder for the records in the page tree

.. _admin-configuration:

Configuration
-------------

* In the typoscript file the page template must configured with the variable named *page*
* In the typoscript setup the plugin must be configured:

   - Only the extension:
   	plugin.tx_calmedia.persistence.storagePid = pid of the folder for the records
   - If the google maps function is used, it must configured in the typoscript:
   	plugin.tx_calmedia {
   		settings {
   			googleApi = the google api code for the homepage
   			
   			googleHPath = the address of the company
   			
   			googleHTitle = the name of the company
   			
   		}
   	}
