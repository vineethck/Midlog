<?php

namespace vini\midlog\Middleware;

use Closure;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

class LogAfterRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $log = new Logger('HTTP');
        $handler = new RotatingFileHandler(config('logger.options.file'), Logger::INFO);
        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context%\n\n"));
        $log->pushHandler($handler);

        if (config('logger.options.enabled')) {

            $inputs = $request->input();

            if (!empty($inputs)) {
                $inputSafe = config('logger.options.input_safe');

                foreach($inputSafe as $safe) {
                    if(!empty($inputs[$safe])) {
                        $inputs[$safe] = '[*** SENSOR ***]';    
                    }
                }
            }

            $request_array = [
                'method'        => $request->method(),
                'full-url'      => $request->fullUrl(),
                'client-ip'     => $request->ip(),
                'user-agent'    => $request->header('user-agent'),
                'query-string'  => $request->query(),
                'inputs'        => $inputs
            ];

            $response_array = [];

            if (config('logger.options.log_response')) {
                $response_array = [
                    'status'    => $response->status(),
                    'content'   => ''
                ];

                json_decode($response->content());
                if (json_last_error() == JSON_ERROR_NONE) {
                    $response_array['content'] = $response->content();
                }
            }

            $log->addInfo('REQUEST', $request_array);
            $log->addInfo('RESPONSE', $response_array);
        }
    }
}
