<?php

declare(strict_types=1);

namespace PayNL\Sdk\Request\Currencies;

use PayNL\Sdk\{
    Request\AbstractRequest,
    Transformer\TransformerInterface,
    Transformer\Currency as CurrencyTransformer
};

/**
 * Class Currencies
 *
 * @package PayNL\Sdk\Request\Currencies
 */
class Get extends AbstractRequest
{
    /**
     * @var string
     */
    protected $abbreviation;

    /**
     * Get constructor.
     *
     * @param string $abbreviation
     */
    public function __construct(string $abbreviation)
    {
        $this->setAbbreviation($abbreviation);
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     *
     * @return Get
     */
    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        $abbreviation = $this->getAbbreviation();
        return 'currencies/' . $abbreviation;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return static::METHOD_GET;
    }

    /**
     * @return CurrencyTransformer
     */
    public function getTransformer(): TransformerInterface
    {
        return new CurrencyTransformer();
    }
}
