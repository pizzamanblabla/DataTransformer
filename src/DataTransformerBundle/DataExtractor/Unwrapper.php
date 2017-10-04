<?php

namespace Pizzamanblabla\DataTransformerBundle\DataExtractor;

use Pizzamanblabla\DataTransformerBundle\DataExtractor\Exception\DataExtractionException;

final class Unwrapper implements DataExtractorInterface
{
    /**
     * @var string
     */
    private $targetKey;

    /**
     * @param string $targetKey
     */
    public function __construct(string $targetKey) {
        $this->targetKey = $targetKey;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($extractable): array
    {
        if (!is_array($extractable) || !array_key_exists($this->targetKey, $extractable)) {
            throw new DataExtractionException();
        }

        return $extractable[$this->targetKey];
    }
}