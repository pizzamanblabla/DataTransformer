<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class Composite implements DataCorrectorInterface
{
    /**
     * @var DataCorrectorInterface[]
     */
    private $container;

    /**
     * @param DataCorrectorInterface[] $container
     */
    public function __construct(array $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function correct(array $data): array
    {
        $corrected = $data;

        foreach ($this->container as $dataCorrector) {
            $corrected = $dataCorrector->correct($corrected);
        }

        return $corrected;
    }
}