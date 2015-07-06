<?php

/**
 * PHP source file for the PipelineCollection trait.
 *
 * @copyright Copyright (c) 2015 SES.
 * @author Serge Kukharev <serge.kukharev@gmail.com>
 */

namespace Sergekukharev\PipelineCollection;

trait PipelineCollection
{

    private $dataField = null;

    /**
     * Applies the callback to each element of the given array.
     * @param callable $callback
     * @return PipelineCollection
     */
    public function map(callable $callback)
    {
        return new self(array_map($callback, $this->dataField));
    }

    /**
     * Calls callback with each element as parameter. If callback returns
     * true, element will be included in resulting collection.
     * @param callable $callback
     * @return PipelineCollection
     */
    public function filter(callable $callback)
    {
        return new self(array_filter($this->dataField, $callback));
    }

    /**
     * Iteratively reduce the collection to a single value using a callback function.
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->dataField, $callback, $initial);
    }

    /**
     * Sets main data field of the collection to use with pipeline methods.
     * @param array $field
     * @return $this
     */
    private function setDataField(array &$field)
    {
        $this->dataField = $field;

        return $this;
    }
}
