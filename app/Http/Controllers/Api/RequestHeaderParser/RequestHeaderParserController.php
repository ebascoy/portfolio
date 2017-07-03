<?php

namespace App\Http\Controllers\Api\RequestHeaderParser;

use App\Api\RequestHeaderParser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestHeaderParserController extends Controller
{
    public function index(Request $request, RequestHeaderParser $parser)
    {
        $result['ipaddress'] = $request->server('REMOTE_ADDR') ?
            $request->server('REMOTE_ADDR') : null;
        $language_arr = $request->server('HTTP_ACCEPT_LANGUAGE') ?
            explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'), 2) : null;
        $result['language'] = $language_arr ? $language_arr[0] : null;
        $user_agent = $request->server('HTTP_USER_AGENT') ?
            $request->server('HTTP_USER_AGENT') : null;
        $result['software'] = $parser->getOS($user_agent);
        return response()->json($result);
    }
}