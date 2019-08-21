<?php

namespace OpenAPIServer\Api;

use Error;
use Exception;
use OpenAPIServer\Service\QuestionListService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DefaultApi extends AbstractDefaultApi
{
    public function questionsGet(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        /** @var QuestionListService $service */
        $service = $this->container->get('questionsListService');
        $lang = $request->getQueryParam('lang');

        try {
            $questionList = $service->getQuestionList($lang);
            return $response->withJson($questionList)->withStatus(200);
        } catch (Error $e) {
            return $response->write($e->getMessage())->withStatus(500);
        } catch (Exception $exception) {
            return $response->write($exception->getMessage())->withStatus(400);
        }
    }

    public function questionsPost(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

    }

}