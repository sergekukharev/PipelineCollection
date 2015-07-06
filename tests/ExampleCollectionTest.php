<?php

/**
 * PHP source file for the TestPipelineTest class.
 *
 * @copyright Copyright (c) 2015 SES.
 * @author Serge Kukharev <sergei.kuharev@stidia.com>
 */

namespace Sergekukharev\PipelineCollection\Tests;

use Sergekukharev\PipelineCollection\ExampleCollection;

class ExampleCollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ExampleCollection */
    private $collection;

    protected function setUp()
    {
        $this->collection = new ExampleCollection(range(1, 5));
    }

    public function testMap()
    {
        $this->assertEquals(
            new ExampleCollection(array(1, 4, 9, 16, 25)),
            $this->collection->map(function ($n) {
                return $n * $n;
            })
        );
    }

    public function testMapAssoc()
    {
        $expected = new ExampleCollection(array('test1' => 6, 'test2' => 20, 'test3' => 36));
        $collection = new ExampleCollection(array('test1' => 3, 'test2' => 10, 'test3' => 18));

        $this->assertEquals(
            $expected,
            $collection->map(function ($n) {
                return $n * 2;
            })
        );
    }

    public function testMapEmpty()
    {
        $expected = new ExampleCollection(array());
        $collection = new ExampleCollection(array());

        $this->assertEquals(
            $expected,
            $collection->map(function ($n) {
                return $n * 2;
            })
        );
    }

    public function testFilter()
    {
        $this->assertEquals(
            new ExampleCollection(array(1, 2, 3)),
            $this->collection->filter(function ($n) {
                return $n <= 3;
            })
        );
        $this->assertEquals(
            new ExampleCollection(array(1, 4 => 5)),
            $this->collection->filter(function ($n) {
                return $n < 2 || $n == 5;
            })
        );
        $this->assertEquals(
            new ExampleCollection(array(1 => 2, 2 => 3, 3 => 4)),
            $this->collection->filter(function ($n) {
                return $n > 1 && $n < 5;
            })
        );
    }

    public function testFilterEmpty()
    {
        $this->assertEquals(
            new ExampleCollection(array()),
            $this->collection->filter(function ($n) {
                return $n > 10;
            })
        );
    }

    public function testReduce()
    {
        $this->assertEquals(15, $this->collection->reduce(function ($carry, $item) {
            return $carry + $item;
        }));
    }

    public function testReduceAssoc()
    {
        $collection = new ExampleCollection(array('test1' => 3, 'test2' => 7, 'test3' => 10));
        $this->assertEquals(20, $collection->reduce(function ($carry, $item) {
            return $carry + $item;
        }));
    }


    public function testReduceString()
    {
        $collection = new ExampleCollection(array('Test1', 'Test2', 'Test3', 'Test4'));
        $this->assertEquals(
            '_Test1_Test2_Test3_Test4',
            $collection->reduce(function ($carry, $item) {
                return $carry . '_' . $item;
            })
        );
    }

    public function testReduceStringWithInitial()
    {
        $collection = new ExampleCollection(array('Test1', 'Test2', 'Test3', 'Test4'));
        $this->assertEquals(
            'init_Test1_Test2_Test3_Test4',
            $collection->reduce(function ($carry, $item) {
                return $carry . '_' . $item;
            }, 'init')
        );
    }
}
