<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StripTags
{
    /**
     * Handle an incoming request and strip all HTML tags from input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Grab all input data
        $input = $request->all();

        // Recursively strip tags from every value
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = strip_tags($value);
            }
        });

        // Merge sanitized data back into the request
        $request->merge($input);

        // Continue handling request
        return $next($request);
    }
}
