# === PayHub Gateway OpenCart Payment Extension ===
Provided by: PayHub, Inc.  (www.payhub.com)
PayHub Support: wecare@payhub.com or 844-205-4332

Created by: Lon Sun
Last Updated By: Agustín Breit
Last Updated On: December 01, 2016

Description: This OpenCart extension allows you to process credit card payments through PayHub Gateway.  A merchant account with PayHub is required.  Contact us to setup an account at www.payhub.com or by calling 1-866-286-1300.

Supported OpenCart Version(s): 2.3.0.2

PLEASE SEE THE LICENSE FILE INCLUDED WITH THIS EXTENSION.


# === Installation Instructions ===
You can get the extension from GitHub: https://github.com/payhubbuilder/payhub-opencart or from http://developer.payhub.com.

These instructions you have already installed OpenCart, are able to access files within your OpenCart deployment, and have access to the OpenCart admin interface.

Once you have the extension downloaded and uncompressed, you should have the following files:

admin/controller/extension/payment/payhub.php
  -Sets the data and fields for configuring PayHub Gateway in the admin section.
admin/language/en-gb/extension/payment/payhub.php
  -Contains actual text for populating the fields found in admin/controller/extension/payment/payhub.php.
admin/view/template/extension/payment/payhub.tpl
  -The view for configuring the PayHub Gateway in the admin section.
catalog/controller/extension/payment/payhub.php
  -Sets the data and payment fields for the checkout page.  Also contains the actual "send()" function that submits the transaction request to the gateway. 
catalog/language/en-gb/extension/payment/payhub.php
  -Contains the actual text for populating the fields found in catalog/controller/extension/payment/payhub.php
catalog/model/extension/payment/payhub.php
  -This file contains logic that seems to determine if PayHub is an option on the checkout page and where it should show up in the payment options l ist (sort order).
catalog/view/theme/default/template/extension/payment/payhub.tpl
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

# === Testing the PayHub Extension ===
You can use the following card numbers to test the PayHub extension.  Please be sure that the "Transaction Mode" setting is set to "Test" for the PayHub extension before testing.

Visa: 
  -card #: 4266841082854082
  -exp date: any date in the future
  -CVV: 999
  -billing address: any valid address
  -Transaction amounts: $.01 for a failure and $10 for a successful result.

MasterCard:
  -card #: 5466410004374507
  -exp date: any date in the future
  -CVV: 998
  -billing address: any valid address
  -Transaction amounts: $.01 for a failure and $10 for a successful result.

**Note:  When you are done testing and ready to go live, you must change the Transaction Mode value to "Live" in the PayHub Gateway extension settings page.  If you forget to do this and make your site live, then people may be able to run transactions through our test system and you will NOT be paid on those transactions!  You are advised to switch the account to "Live" and then test with your own card to verfiy everything is working correctly end-to-end.  You can then void the transaction via your Virtual Hub log in.
