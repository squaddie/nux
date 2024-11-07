<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerifyLink
 * @package App\Http\Middleware\VerifyLink
 */
class VerifyLink
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

        if ($link->isDisabled()) {
            return redirect()->route('auth.view')->with('disabledLink', $request->route('link'));
        }

        if ($link->isLinkExpired()) {
            return redirect()->route('auth.view')->with('expiredLink', $request->route('link'));
        }

        return $next($request);
    }
}
