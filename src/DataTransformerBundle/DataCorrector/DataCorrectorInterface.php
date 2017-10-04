<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

interface DataCorrectorInterface
{
    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    public function correct(array $data): array;
}