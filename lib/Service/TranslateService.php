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

    public function translate($text, $targetLanguage, $sourceLanguage = 'en') : string
    {
        return $this->translateRepository->translate($text, $targetLanguage, $sourceLanguage);
    }

}