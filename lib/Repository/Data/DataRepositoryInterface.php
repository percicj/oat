<?php

namespace OpenAPIServer\Repository\Data;

interface DataRepositoryInterface
{
    public function getData() : array;
}