<?php

namespace Pizzamanblabla\DataTransformerBundle\PayloadModifier;

interface PayloadModifierInterface
{
    /**
     * @param mixed $modifiable
     * @return mixed
     */
    public function modify($modifiable);
}