<?php

namespace OpenAPIServer\Service;

use DateTime;
use Exception;
use OpenAPIServer\Model\QuestionList;
use OpenAPIServer\Model\Question;
use OpenAPIServer\Model\Choice;
use OpenAPIServer\Repository\Data\DataRepositoryInterface;
use OpenAPIServer\Repository\Translate\TranslateRepositoryInterface;
use PHLAK\Config\Config;

class QuestionListService
{
    /**
     * @var Config $config
     */
    private $config;

    /**
     * @var TranslateRepositoryInterface $translator
     */
    private $translator;

    public function __construct(Config $config, TranslateRepositoryInterface $translator)
    {
        $this->config = $config;
        $this->translator = $translator;
    }

    public function getQuestionList(string $lang) : QuestionList
    {
        $data = $this->getData();

        if (empty($data)) {
            throw new Exception('No data found');
        }

        $questions = $this->getQuestions($data, $lang);

        return new QuestionList($questions);
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
            $this->translator->translate($text, $lang)
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
            $this->translator->translate($text, $lang),
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