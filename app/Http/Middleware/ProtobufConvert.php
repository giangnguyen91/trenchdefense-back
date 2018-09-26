<?php

namespace App\Http\Middleware;

use App\Utils\CommunicationUtil;
use App\Utils\Util;
use Closure;
use Illuminate\Http\Request;

class ProtobufConverter
{
    /**
     * protobuf
     * @var array
     */
    private $ignorePaths = [
    ];


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->is(...$this->ignorePaths)) {
            $request = $this->convert($request);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return Request
     */
    private function convert(Request $request)
    {
        if ($request->isMethod("GET")) {
            $content = $request->get("body");
            $content = hex2bin($content);
        } else{
            $content = $request->getContent();
        }

        if (empty($content)) {
            return $request;
        }

        $models = Util::deserialize($content);

        /* @var $model \DrSlump\Protobuf\Message */
        foreach ($models as $model) {
            $request->offsetSet(get_class($model), $model);
        }

        return $request;
    }
}
