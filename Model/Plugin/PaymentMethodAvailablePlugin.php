<?php

namespace InfinitumSpace\CheckmoPermission\Model\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Payment\Model\MethodInterface;
use Magento\Quote\Api\Data\CartInterface;

class PaymentMethodAvailablePlugin
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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

        if (!$quote || !$quote->getCustomerId()) {
            return false;
        }

        try {
            $customer = $this->customerRepository->getById($quote->getCustomerId());
            $attribute = $customer->getCustomAttribute('allow_checkmo');
            return (int)$attribute?->getValue() === 1;
        } catch (\Exception $e) {
            return false;
        }
    }
}
