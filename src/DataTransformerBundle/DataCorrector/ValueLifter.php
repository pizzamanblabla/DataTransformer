<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

final class ValueLifter implements DataCorrectorInterface
{
    /**
     * @var string
     */
    private $targetNode;

    /**
     * @var string[]
     */
    private $nodeMap;

    /**
     * @param string $targetNode
     * @param string[] $nodeMap
     */
    public function __construct(string $targetNode, array $nodeMap)
    {
        $this->targetNode = $targetNode;
        $this->nodeMap = $nodeMap;
    }

    /**
     * {@inheritdoc}
     */
    public function correct(array $data): array
    {
        $correctedData = [];

        foreach ($data as $key => $value) {
            if ($key == $this->targetNode && $key && is_array($value)) {
                $correctedData[$key] = $this->bringTargetContent($value);
            } elseif (is_array($value)) {
                $correctedData[$key] = $this->correct($value);
            } else {
                $correctedData[$key] = $value;
            }
        }

        return $correctedData;
    }

    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    private function bringTargetContent(array $data): array
    {
        $targetContent = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->nodeMap) && $key) {

                if (is_numeric($key)) {
                    $key = $key . 'N';
                }

                $targetContent[$key] = $value;
            } elseif (is_array($value)) {
                $targetContent = array_merge($this->bringTargetContent($value), $targetContent);
            }
        }

        return $targetContent;
    }
}