<?php

namespace Pizzamanblabla\DataTransformerBundle\DataParser;

use Pizzamanblabla\DataTransformerBundle\DataCorrector\DataCorrectorInterface;
use Pizzamanblabla\DataTransformerBundle\DataExtractor\DataExtractorInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class DataParser implements DataParserInterface
{
    use LoggerAwareTrait;

    /**
     * @var DataExtractorInterface
     */
    private $dataExtractor;

    /**
     * @var DataCorrectorInterface
     */
    private $dataCorrector;

    /**
     * @param DataExtractorInterface $dataExtractor
     * @param DataCorrectorInterface $dataCorrector
     */
    public function __construct(
        DataExtractorInterface $dataExtractor,
        DataCorrectorInterface $dataCorrector,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->dataExtractor = $dataExtractor;
        $this->dataCorrector = $dataCorrector;
    }

    /**
     * {@inheritdoc}
     */
    public function parse($data): array
    {
        $this->logger->info('Extracting data');
        $extracted = $this->dataExtractor->extract($data);

        $this->logger->info('Correcting extracted data');
        return $this->dataCorrector->correct($extracted);
    }
}