<?php

namespace App\Providers;

use App\Library\Error;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //error
        Response::macro('fail', function ($err_code, $result=null, $msg='') {
            if (is_null($result)){
                $result = [];
            }
            if ($msg) {
                $err_msg = $msg;
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
        });

        //正常返回
        Response::macro('success', function ($result=null) {
            if (is_null($result)){
                $result = [];
            }
            $response_data = [
                'code' => 1,
                'data' => $result,
            ];

            app('log')->debug(sprintf('params [%s] response [%s]',
                json_encode(request()->all(), JSON_UNESCAPED_UNICODE),
                json_encode($result, JSON_UNESCAPED_UNICODE)
            ));
            return Response::json($response_data);
        });

    }
}
