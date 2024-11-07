<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Link;
use App\Services\LinkGeneratorBuilderService;
use App\Services\MakeLuckyService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Random\RandomException;

/**
 * Class LinkController
 * @package App\Http\Controllers\LinkController
 */
class LinkController extends Controller
{
    /** @var Link $linkModel */
    private Link $linkModel;
    /** @var History $historyModel */
    private History $historyModel;

    /**
     * @param Link $linkModel
     * @param History $historyModel
     */
    public function __construct(Link $linkModel, History $historyModel)
    {
        $this->linkModel = $linkModel;
        $this->historyModel = $historyModel;
    }

    /**
     * @param string $link
     * @return Renderable
     */
    public function link(string $link): Renderable
    {
        return view('pages.link', ['link' => $link]);
    }

    /**
     * @param string $link
     * @return Renderable
     */
    public function history(string $link): Renderable
    {
        $linkInstance = $this->linkModel->findByLink($link);

        return view('pages.history', [
            'history' => $this->historyModel->getLatestHistoryFilteredByLinkID($linkInstance->id),
            'link' => $link,
        ]);
    }

    /**
     * @param string $link
     * @param Request $request
     * @param LinkGeneratorBuilderService $linkGeneratorBuilderService
     * @return RedirectResponse
     */
    public function create(
        string $link,
        Request $request,
        LinkGeneratorBuilderService $linkGeneratorBuilderService
    ): RedirectResponse {
        $newLink = $linkGeneratorBuilderService->createLink()->storeLink($request->user()->id)->getLink();

        return redirect()->route('link', ['link' => $link])->with('newLink', $newLink);
    }

    /**
     * @param string $link
     * @return Renderable
     */
    public function getLucky(string $link): Renderable
    {
        $linkInstance = $this->linkModel->findByLink($link);

        return view('pages.imfeelinglucky', [
            'result' => $this->historyModel->getLastHistoryFilteredByLinkID($linkInstance->id),
            'link' => $link,
        ]);
    }

    /**
     * @param string $link
     * @param MakeLuckyService $makeLuckyService
     * @return RedirectResponse
     * @throws Exception
     */
    public function makeLucky(string $link, MakeLuckyService $makeLuckyService): RedirectResponse
    {
        $makeLuckyService->makeLucky($link);

        return redirect()->route('link.lucky.view', ['link' => $link]);
    }


    /**
     * @param string $link
     * @param Link $linkModel
     * @return RedirectResponse
     */
    public function disable(string $link, Link $linkModel): RedirectResponse
    {
        $linkModel->disable($link);

        return redirect()->route('auth.view')->with('disabledLink', $link);
    }
}
