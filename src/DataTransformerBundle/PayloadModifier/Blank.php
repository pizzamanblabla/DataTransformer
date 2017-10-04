<?php

namespace Pizzamanblabla\DataTransformerBundle\PayloadModifier;

final class Blank implements PayloadModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify($modifiable)
    {
        return $modifiable;
    }
}