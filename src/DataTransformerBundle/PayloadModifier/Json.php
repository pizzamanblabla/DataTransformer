<?php

namespace Pizzamanblabla\DataTransformerBundle\PayloadModifier;

final class Json implements PayloadModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify($modifiable)
    {
        $modified =  json_decode($modifiable, 1);

        return is_array($modified) ? $modified : [];
    }
}