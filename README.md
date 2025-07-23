# InfinitumSpace\_CheckmoPermission

Magento 2 module that adds a **"Allow Check / Money order"** attribute to the customer entity and conditionally enables the **Check / Money Order** (`checkmo`) payment method based on that attribute.

---

## ✨ Features

* Adds `allow_checkmo` attribute to `customer` entity.
* Attribute is visible only in the Admin Panel on the customer edit page.
* The `checkmo` payment method is available only if:

    * it is **enabled in configuration**, and
    * the **logged-in customer has the attribute enabled**.

---

## 📦 Installation

### Composer (recommended)

```bash
composer require infinitum-space/module-checkmo-permission
bin/magento module:enable InfinitumSpace_CheckmoPermission
bin/magento setup:upgrade
bin/magento cache:flush
```

### Manual Installation (alternative)

1. Copy the module to:

   ```
   app/code/InfinitumSpace/CheckmoPermission
   ```

2. Run the following commands:

   ```bash
   bin/magento module:enable InfinitumSpace_CheckmoPermission
   bin/magento setup:upgrade
   bin/magento cache:flush
   ```

3. Ensure that the **Check / Money Order** payment method is enabled:

    * Go to:
      `Stores → Configuration → Sales → Payment Methods → Check / Money Order`
    * Set `Enabled = Yes`

---

## 📃 Customer Attribute

* **Code**: `allow_checkmo`
* **Type**: Boolean (Yes / No)
* **Form**: `adminhtml_customer` only
* **Default value**: No

---

## 💳 checkmo Payment Visibility Logic

| Condition                               | checkmo available? |
| --------------------------------------- | ------------------ |
| checkmo disabled in configuration       | ❌                  |
| Customer not logged in                  | ❌                  |
| Customer attribute not enabled          | ❌                  |
| Customer attribute enabled + checkmo on | ✅                  |

---

## 📊 Dependencies

This module depends on the following Magento components:

* `Magento_Customer`
* `Magento_Eav`
* `Magento_Payment`
* `Magento_Quote`
* `Magento_Ui`

---

## 📄 License

MIT

---

## 📧 Support

Developer: [unicorn.ares](mailto:unicorn.ares@outlook.com)
