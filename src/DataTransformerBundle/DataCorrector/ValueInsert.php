<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class ValueInsert implements DataCorrectorInterface
{
    /**
     * @var string[]
     */
    private $nodeMap;

    /**
     * @param string[] $nodeMap
     */
    public function __construct(array $nodeMap)
    {
        $this->nodeMap = $nodeMap;
    }

    /**
     * {@inheritdoc}
     */
    public function correct(array $data): array
    {
        $correctedData = [];

        foreach ($data as $key => $value) {
            if (isset($this->nodeMap[$key]) && is_array($value)) {
                $correctedData[$key] = array_merge($this->correct($value), $this->nodeMap[$key]);
            } elseif (is_array($value)) {
                $correctedData[$key] = $this->correct($value);
            } else {
                $correctedData[$key] = $value;
            }
        }

        return $correctedData;
    }
}