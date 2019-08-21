<?php

namespace OpenAPIServer\Repository\Data;

class CSVDataRepository implements DataRepositoryInterface
{
    /**
     * @var string $filename
     */
    private $filename;

    public function __construct(array $settings)
    {
        $this->filename = $settings['filename'];
    }

    public function getData() : array
    {
        return [];
    }
}