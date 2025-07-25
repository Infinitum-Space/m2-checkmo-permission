<?php

namespace InfinitumSpace\CheckmoPermission\Model\Plugin;

use Magento\Payment\Model\MethodInterface;
use Magento\Quote\Api\Data\CartInterface;
use \Magento\Customer\Model\Session;

class PaymentMethodAvailablePlugin
{
    protected Session $customerSession;

    public function __construct(
        Session $customerSession,
    )
    {
        $this->customerSession = $customerSession;
    }

    public function afterIsAvailable(
        MethodInterface $subject,
        $result,
        CartInterface $quote = null
    )
    {
        if ($subject->getCode() !== 'checkmo') {
            return $result;
        }

        if (!$this->customerSession->isLoggedIn()) {
            return false;
        }

        try {
            $attribute = $this->customerSession->getCustomerData()->getCustomAttribute('allow_checkmo');
            return (int)$attribute?->getValue() === 1 && $result;
        } catch (\Exception $e) {
            return false;
        }
    }
}

