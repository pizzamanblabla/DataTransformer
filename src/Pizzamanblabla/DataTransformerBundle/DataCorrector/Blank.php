<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class Blank implements DataCorrectorInterface
{
    /**
     * {@inheritdoc}
     */
    public function correct(array $data): array
    {
        return $data;
    }
}