<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class NodeGrouper implements DataCorrectorInterface
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
            if (isset($this->nodeMap[$key])) {
                if (is_array($value)) {
                    $correctedData[$this->nodeMap[$key]][$key] = $this->correct($value);
                } else {
                    $correctedData[$this->nodeMap[$key]][$key] = $value;
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