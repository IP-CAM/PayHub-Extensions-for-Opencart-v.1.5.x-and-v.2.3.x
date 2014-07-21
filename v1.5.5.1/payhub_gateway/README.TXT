=== PayHub Gateway OpenCart Payment Extension ===
Provided by: PayHub, Inc.  (www.payhub.com)
PayHub Support: wecare@payhub.com or 844-205-4332

Created by: Lon Sun
Last Updated By: Lon Sun
Last Updated On: July 20, 2014

Description: This OpenCart extension allows you to process credit card payments through PayHub Gateway.  A merchant account with PayHub is required.  Contact us to setup an account at www.payhub.com or by calling 1-866-286-1300.

Supported OpenCart Version(s): 1.5.5.1

=== Release Notes ===
v1.0 - July 20, 2014
  -Initial Release

=== Installation Instructions ===
You can get the extension from GitHub: https://github.com/payhubbuilder/payhub-opencart or from http://developer.payhub.com.

These instructions you have already installed OpenCart, are able to access files within your OpenCart deployment, and have access to the OpenCart admin interface.

Once you have the extension downloaded and uncompressed, you should have the following files:

admin/controller/payment/payhub.php
  -Sets the data and fields for configuring PayHub Gateway in the admin section.
admin/language/english/payment/payhub.php
  -Contains actual text for populating the fields found in admin/controller/payment/payhub.php.
admin/view/template/payment/payhub.tpl
  -The view for configuring the PayHub Gateway in the admin section.
catalog/controller/payment/payhub.php
  -Sets the data and payment fields for the checkout page.  Also contains the actual "send()" function that submits the transaction request to the gateway. 
catalog/language/english/payment/payhub.php
  -Contains the actual text for populating the fields found in catalog/controller/payment/payhub.php
catalog/model/payment/payhub.php
  -This file contains logic that seems to determine if PayHub is an option on the checkout page and where it should show up in the payment options l ist (sort order).
catalog/view/theme/default/template/payment/payhub.tpl
  -The view for presenting the payment fields on the checkout page.  This plugin has only been tested with the default theme, but should work fine with most custom themes.
README.TXT
  -General information and installation instructions.

To install, just copy the above files to their respective directories in you OpenCart deployment. Then log into your OpenCart admin interface and perform the following steps:
  -Go to Extensions -> Payments.
  -You should see a "PayHub Gateway" as a payment option.
  -Click on the "Install" link to the far ratel on the PayHub Gateway row.
  -Fill in the information, as appropriate.  Note that your access credentials can be obtained by logging into your Virtual Hub account and going to Admin -> 3rd Party API.
  -Make sure that the "Status" is "Enabled".
  -Change any other settings as you see fit.
  -Save your settings.

Now you should see PayHub as an option when checking out.
