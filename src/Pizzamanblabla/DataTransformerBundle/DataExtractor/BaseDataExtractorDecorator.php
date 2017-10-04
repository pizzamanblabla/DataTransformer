<?php

namespace Pizzamanblabla\DataTransformerBundle\DataExtractor;

abstract class BaseDataExtractorDecorator implements DataExtractorInterface
{
    /**
     * @var DataExtractorInterface
     */
    protected $dataExtractor;

    /**
     * @param DataExtractorInterface $dataExtractor
     */
    public function __construct(DataExtractorInterface $dataExtractor)
    {
        $this->dataExtractor = $dataExtractor;
    }
}