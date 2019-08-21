<?php

namespace OpenAPIServer\Repository\Data;

class JSONDataRepository implements DataRepositoryInterface
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
        return json_decode(file_get_contents($this->filename), true);
    }

    public function writeData(): array
    {
        // TODO: Implement writeData() method.
    }
}