<?php

declare(strict_types=1);

namespace PayNL\Sdk\Hydrator;

use PayNL\Sdk\{
    Model\PaymentMethods as PaymentMethodsModel,
    Model\PaymentMethod as PaymentMethodModel,
    Hydrator\PaymentMethod as PaymentMethodHydrator
};

/**
 * Class PaymentMethods
 *
 * @package PayNL\Sdk\Hydrator
 */
class _PaymentMethods extends AbstractHydrator
{
    /**
     * @inheritDoc
     *
     * @return PaymentMethodsModel
     */
    public function hydrate(array $data, $object): PaymentMethodsModel
    {
        $this->validateGivenObject($object, PaymentMethodsModel::class);

        if (false === array_key_exists('paymentMethods', $data)) {
            // assume given data is collection of paymentMethods
            $data = [
                'paymentMethods' => $data,
            ];
        }

        foreach ($data['paymentMethods'] as $key => $paymentMethod) {
            $data['paymentMethods'][$key] = (new PaymentMethodHydrator())->hydrate($paymentMethod, new PaymentMethodModel());
        }

        /** @var PaymentMethodsModel $paymentMethods */
        $paymentMethods = parent::hydrate($data, $object);
        return $paymentMethods;
    }
}
