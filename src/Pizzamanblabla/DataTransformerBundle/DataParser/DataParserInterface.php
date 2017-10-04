<?php

namespace Pizzamanblabla\DataTransformerBundle\DataParser;

interface DataParserInterface
{
    /**
     * @param $data
     * @return array
     */
    public function parse($data): array;
}