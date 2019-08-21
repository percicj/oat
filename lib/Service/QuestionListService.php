<?php

namespace OpenAPIServer\Service;

use DateTime;
use Exception;
use OpenAPIServer\Model\QuestionList;
use OpenAPIServer\Model\Question;
use OpenAPIServer\Model\Choice;
use OpenAPIServer\Repository\Data\DataRepositoryInterface;
use PHLAK\Config\Config;

class QuestionListService
{
    /**
     * @var Config $config
     */
    private $config;

    /**
     * @var TranslateService $translateService
     */
    private $translateService;

    public function __construct(Config $config, TranslateService $translateService)
    {
        $this->config = $config;
        $this->translateService = $translateService;
    }

    /**
     * Return list of questions with choices
     *
     * @param string $lang
     * @return QuestionList
     * @throws Exception
     */
    public function getQuestionList(string $lang) : QuestionList
    {
        $data = $this->getData();

        if (empty($data)) {
            throw new Exception('No data found');
        }

        $questions = $this->getQuestions($data, $lang);

        return new QuestionList($questions);
    }

    /**
     * Save questions to storage
     *
     * @param array $question
     * @throws Exception
     */
    public function saveQuestion(array $question) : void
    {
        $this->getRepository()->writeData($question);
    }

    private function getChoices(array $choices, string $lang) : array
    {
        $choiceList = [];
        foreach ($choices as $choice) {
            $choiceList[] = $this->getChoice($choice['text'], $lang);
        }
        return $choiceList;
    }

    private function getChoice(string $text, string $lang) : Choice
    {
        return new Choice(
            $this->translateService->translate($text, $lang)
        );
    }

    private function getQuestions(array $questions, string $lang) : array
    {
        $questionList = [];
        foreach ($questions as $question) {
            $choices = $this->getChoices($question['choices'], $lang);
            $questionList[] = $this->getQuestion($question['text'], new DateTime($question['createdAt']), $choices, $lang);
        }

        return $questionList;
    }

    private function getQuestion(string $text, DateTime $createdAt, array $choices, string $lang) : Question
    {
        return new Question(
            $this->translateService->translate($text, $lang),
            $createdAt,
            $choices
        );
    }

    /**
     * @throws Exception
     */
    private function getData() : array
    {
        return $this->getRepository()->getData();
    }

    private function getRepository() : DataRepositoryInterface
    {
        $repository = $this->config['data']['repository'];

        if (!class_exists($repository)) {
            throw new Exception('Repository not found!');
        }

        return new $repository($this->config['data']['settings']);
    }

}