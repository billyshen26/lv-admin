<?php

namespace Zcwilt\Api\Controllers;

use App\Library\Error;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Zcwilt\Api\Exceptions\ApiException;

class AbstractApiController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): AbstractApiController
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respond($result, array $headers = []): JsonResponse
    {
        if (is_null($result)){
            $data = [];
        }else{
            $result = $result->toArray();
            if (isset($result['total'])){
                $data = [
                    'list' => $result['data'],
                    'pagination' => [
                        'total' => $result['total'],
                        'current_page' => $result['current_page'],
                        'limit' => +$result['per_page'],
                    ],
                ];
            }else{
                $data = $result;
            }
        }

        $response_data = [
            'code' => 20000,
            'data' => $data,
        ];
        app('log')->debug(sprintf('params [%s] response [%s]',
            json_encode(request()->all(), JSON_UNESCAPED_UNICODE),
            json_encode($result, JSON_UNESCAPED_UNICODE)
        ));
        return Response::json($response_data);
    }

    /**
     * Notes:
     * Author: BillyShen likeboat@163.com
     * Time: 2020/3/18 9:27 下午
     * @param $err_code
     * @param null $result
     * @param string $message
     * @return JsonResponse
     */
    protected function respondWithError($err_code, $result=null, $message=''): JsonResponse
    {
        if (is_null($result)){
            $result = [];
        }
        if ($message) {
            $err_msg = $message;
        } else {
            $err_msg = Error::errMsg($err_code);
        }
        $response_data = [
            'code' => $err_code,
            'message' => $err_msg,
        ];
        app('log')->error(sprintf('params [%s] response [%s]',
            json_encode(request()->all(), JSON_UNESCAPED_UNICODE),
            json_encode($response_data, JSON_UNESCAPED_UNICODE)
        ));
        return Response::json($response_data);

    }

    protected function handleExceptionMessage(\Exception $e)
    {
        $queryException = false;
        if ($e instanceof QueryException || $e instanceof RelationNotFoundException) {
            $queryException = true;
        }
        $production = (\App::environment() === 'production');
        if ($e instanceof ApiException) {
            return $e->getMessage();
        }
        $message = 'Invalid Query - probably invalid field name';
        if ($queryException && $production) {
            return $message;
        }
        if ($queryException) {
            return $e->getMessage();
        }
        throw $e;
    }
}
