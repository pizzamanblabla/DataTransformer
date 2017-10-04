<?php

namespace Pizzamanblabla\DataTransformerBundle\DataCorrector;

use PHPUnit\Framework\TestCase;

final class ValueWrapperTest extends TestCase
{
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
                'Successful Wrapping' =>
                    [
                        'keys map' =>
                            [
                                'test3' => 'target',
                                'test2' => 'target_two',
                            ],
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
                                                'target' => ['key1' => 'value1'],
                                            ],
                                    ],
                                'test2' =>
                                    [
                                        'target_two' => ['value', 'value_two']
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
     * @return ValueWrapper
     */
    private function createCorrector(array $keysMap): ValueWrapper
    {
        return new ValueWrapper($keysMap);
    }
}