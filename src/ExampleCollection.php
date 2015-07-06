<?php

namespace Sergekukharev\PipelineCollection;

class ExampleCollection
{
    use PipelineCollection;

    /** @var array  */
    private $authors;

    public function __construct(array $data)
    {
        $this->authors = $data;

        $this->setDataField($this->authors);
    }
}


