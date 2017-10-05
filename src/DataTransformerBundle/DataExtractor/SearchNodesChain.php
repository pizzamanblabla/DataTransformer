<?php

namespace Pizzamanblabla\DataTransformerBundle\DataExtractor;

final class SearchNodesChain implements DataExtractorInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $decoratedDataExtractor;

    /**
     * @var string[]
     */
    private $targetKeys;

    /**
     * @param DataExtractorInterface $decoratedDataExtractor
     * @param string[] $targetKeys
     */
    public function __construct(DataExtractorInterface $decoratedDataExtractor, array $targetKeys)
    {
        $this->decoratedDataExtractor = $decoratedDataExtractor;
        $this->targetKeys = $targetKeys;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($extractable): array
    {
        $extracted = $this->decoratedDataExtractor->extract($extractable);

        return $this->search($extracted);
    }

    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    private function search(array $data): array
    {
        $found = [];

        foreach ($data as $key => $value) {
            if (is_string($key) && in_array($key, array_keys($this->targetKeys))) {
                if (is_array($value) && in_array($this->targetKeys[$key], array_keys($value))) {
                    $found[$this->targetKeys[$key]] = $value[$this->targetKeys[$key]];
                }
            } elseif (is_array($value)) {
                $found = array_merge($found, $this->search($value));
            }
        }

        return $found;
    }
}