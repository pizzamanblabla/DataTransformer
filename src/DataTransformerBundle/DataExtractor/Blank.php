<?php

namespace Pizzamanblabla\DataTransformerBundle\DataExtractor;

use Pizzamanblabla\DataTransformerBundle\DataExtractor\Exception\DataExtractionException;

final class Blank implements DataExtractorInterface
{
    /**
     * {@inheritdoc}
     */
    public function extract($data): array
    {
        if (!is_array($data)) {
            throw new DataExtractionException('Income should be an array');
        }

        return $data;
    }
}