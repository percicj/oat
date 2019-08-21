<?php

namespace OpenAPIServer\Service;

use OpenAPIServer\Repository\Translate\TranslateRepositoryInterface;

class TranslateService
{
    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    public function __construct(TranslateRepositoryInterface $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    /**
     * Translates text from source language into target language
     *
     * @param string $text
     * @param string $targetLanguage
     * @param string $sourceLanguage
     * @return string
     */
    public function translate(string $text, string $targetLanguage, $sourceLanguage = 'en') : string
    {
        if (empty($targetLanguage)) {
            return $text;
        }
        return $this->translateRepository->translate($text, $targetLanguage, $sourceLanguage);
    }

}