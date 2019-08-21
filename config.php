<?php

return [
        'data' => [
                'repository' => '\\OpenAPIServer\\Repository\\Data\\CSVDataRepository',
                'settings' => [
                    'filename' => dirname(__FILE__) . '/data/questions.csv'
                ],
//                'repository' => '\\OpenAPIServer\\Repository\\Data\\JSONDataRepository',
//                'settings' => [
//                    'filename' => dirname(__FILE__) . '/data/questions.json'
//                ]
        ]
];