<?php


namespace OpenAPIServer\Repository\Translate;


interface TranslateRepositoryInterface
{
    public function translate($text, $targetLanguage, $sourceLanguage = 'en');
}