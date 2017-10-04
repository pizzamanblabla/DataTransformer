<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

use PHPUnit\Framework\TestCase;

final class ValueLifterTest extends TestCase
{
    const TARGET_NODE = 'target_node';

    /**
     * @test
     * @dataProvider correctDateProvider
     */
    public function correct(array $keysMap, array $input, array $expected)
    {
        $corrector = $this->createCorrector($keysMap);

        $actual = $corrector->correct($input);

        self::assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function correctDateProvider()
    {
        return
            [
                'Successful Lifting' =>
                    [
                        'keys map' =>
                            [
                                'target',
                                'target_two',
                            ],
                        'input' =>
                            [
                                'target_node' =>
                                    [
                                        'test3' =>
                                            [
                                                'target' => ['key1' => 'value1'],
                                            ],
                                    ],
                                'test2' =>
                                    [
                                        'value',
                                        'value_two',
                                    ],
                            ],
                        'expected' =>
                            [
                                'target_node' =>
                                    [
                                        'target' => ['key1' => 'value1'],
                                    ],
                                'test2' =>
                                    [
                                        'value',
                                        'value_two',
                                    ],
                            ],
                    ],
                'Without map keys, data untouched' => [
                    'key map' => [],
                    'input' =>
                        [
                            'test' =>
                                [
                                    'test3' =>
                                        [
                                            'key1' => 'value1',
                                        ],
                                ],
                            'test2' =>
                                [
                                    'value',
                                    'value_two',
                                ],
                        ],
                    'expected' =>
                        [
                            'test' =>
                                [
                                    'test3' =>
                                        [
                                            'key1' => 'value1',
                                        ],
                                ],
                            'test2' =>
                                [
                                    'value',
                                    'value_two',
                                ],
                        ],
                ],
            ];
    }

    /**
     * @param string[] $keysMap
     * @return ValueLifter
     */
    private function createCorrector(array $keysMap): ValueLifter
    {
        return new ValueLifter(self::TARGET_NODE, $keysMap);
    }
}