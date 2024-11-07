<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticateByLink
 * @package App\Http\Middleware\AuthenticateByLink
 */
class AuthenticateByLink
{
    /** @var Link $linkModel */
    private Link $linkModel;

    /**
     * @param Link $linkModel
     */
    public function __construct(Link $linkModel)
    {
        $this->linkModel = $linkModel;
    }

    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $link = $this->linkModel->findByLink($request->route('link'));

        Auth::login($link->user);

        return $next($request);
    }
}
