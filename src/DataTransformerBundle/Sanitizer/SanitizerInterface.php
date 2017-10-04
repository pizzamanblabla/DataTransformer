<?php

namespace Pizzamanblabla\DataTransformerBundle\Sanitizer;

interface SanitizerInterface
{
    /**
     * @param string $data
     * @return string
     */
    public function sanitize(string $data): string;
}