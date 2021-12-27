<?php

namespace ISaadSalman\StatamicAnalytics\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Models\PageView;

class Analytics
{
    public function handle(Request $request, Closure $next)
    {

        $uri = str_replace($request->root(), '', $request->url()) ?: '/';

        $response = $next($request);

        // remove the analytics routes and user agent is empty ignore

        if ($request->headers->get('user-agent') == '' || $request->is( config('statamic-analytics.exclude') )) {
            return $response;
        } 
        
        $agent = new Agent();
        $agent->setUserAgent($request->headers->get('user-agent'));
        $agent->setHttpHeaders($request->headers);


        $referer = null;


        if ( $request->headers->get('referer') && !str_starts_with($request->headers->get('referer'), $request->root())) {
            $referer  = $request->headers->get('referer');
        }
 
        PageView::create([
            'session' => $request->session()->getId(),
            'uri' => $uri,
            'source' => $referer ,
            'country' => $agent->languages()[0] ?? 'en-en',
            'browser' => $agent->browser() ?? null,
            'device' => $agent->deviceType(),
        ]);

        return $response;
    }

    protected function input(Request $request): array
    {
        $files = $request->files->all();

        array_walk_recursive($files, function (&$file) {
            $file = [
                'name' => $file->getClientOriginalName(),
                'size' => $file->isFile() ? ($file->getSize() / 1000) . 'KB' : '0',
            ];
        });

        return array_replace_recursive($request->input(), $files);
    }
}