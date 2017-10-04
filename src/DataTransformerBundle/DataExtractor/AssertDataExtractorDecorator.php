<?php

namespace Pizzamanblabla\DataTransformerBundle\DataExtractor;

final class AssertDataExtractorDecorator extends BaseDataExtractorDecorator
{
    /**
     * @var string
     */
    private $assertToEntity;

    /**
     * @param DataExtractorInterface $dataExtractor
     * @param string $assertToEntity
     */
    public function __construct(DataExtractorInterface $dataExtractor, $assertToEntity)
    {
        parent::__construct($dataExtractor);

        $this->assertToEntity = $assertToEntity;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($data): array
    {
        assert($data instanceof $this->assertToEntity);

        return $this->dataExtractor->extract($data);
    }
}