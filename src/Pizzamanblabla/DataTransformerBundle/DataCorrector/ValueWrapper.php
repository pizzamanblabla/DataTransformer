<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class ValueWrapper implements DataCorrectorInterface
{
    /**
     * @var string[]
     */
    private $keysMap;

    /**
     * @param string[] $keysMap
     */
    public function __construct(array $keysMap)
    {
        $this->keysMap = $keysMap;
    }

    /**
     * {@inheritdoc}
     */
    public function correct(array $data): array
    {
        $correctedData = [];

        foreach ($data as $key => $value) {
            if (isset($this->keysMap[$key])) {
                if (is_array($value)) {
                    $correctedData[$key][$this->keysMap[$key]] = $this->correct($value);
                } else {
                    $correctedData[$key][$this->keysMap[$key]] = $value;
                }
            } elseif (is_array($value)) {
                $correctedData[$key] = $this->correct($value);
            } else {
                $correctedData[$key] = $value;
            }
        }

        return $correctedData;
    }
}