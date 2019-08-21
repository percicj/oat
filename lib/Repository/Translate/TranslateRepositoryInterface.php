<?php


namespace OpenAPIServer\Repository\Translate;


interface TranslateRepositoryInterface
{
    public function translate(string $text, string $targetLanguage, string$sourceLanguage) : string;
}