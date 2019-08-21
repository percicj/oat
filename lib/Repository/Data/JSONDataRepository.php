<?php

namespace OpenAPIServer\Repository\Data;

use phpDocumentor\Reflection\Types\Void_;

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

    public function writeData($data) : void
    {
        $existingData = $this->getData();
        $data['createdAt'] = date('Y-m-d H:i:s');
        $existingData[] = $data;

        var_dump($existingData);

        file_put_contents($this->filename, json_encode($existingData));
    }
}