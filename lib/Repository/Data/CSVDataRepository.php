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
        $data = $this->readCsv();
        $parsedData = $this->parseRawData($data);
        return $parsedData;
    }

    private function readCsv() : array
    {
        $data = [];
        $file = fopen($this->filename, 'r');
        while(($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        unset($data[0]);
        return $data;
    }

    private function parseRawData(array $data) : array
    {
        $parsedData = [];
        foreach ($data as $row) {
            $parsedData[] = [
                'text' => $row[0],
                'createdAt' => $row[1],
                'choices' => [
                    [
                        'text' => $row[2],
                    ],
                    [
                        'text' => $row[3],
                    ],
                    [
                        'text' => $row[4],
                    ],
                ],
            ];
        }
        return $parsedData;
    }
}