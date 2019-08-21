<?php


namespace OpenAPIServer\Repository\Translate;


use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslateRepository implements TranslateRepositoryInterface
{
    /**
     * @var GoogleTranslate $googleTranslate
     */
    private $googleTranslate;

    public function __construct(GoogleTranslate $googleTranslate)
    {
        $this->googleTranslate = $googleTranslate;
    }

    public function translate($text, $targetLanguage, $sourceLanguage = 'en') : string
    {
        return $this->googleTranslate->setSource($sourceLanguage)->setTarget($targetLanguage)->translate($text);
    }
}