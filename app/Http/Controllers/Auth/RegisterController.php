<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\LinkGeneratorBuilderService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator as ContractsValidator;
use Illuminate\Validation\ValidationException;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth\RegisterController
 */
class RegisterController extends Controller
{
    /** @var LinkGeneratorBuilderService $linkGeneratorBuilderService */
    protected LinkGeneratorBuilderService $linkGeneratorBuilderService;
    /** @var User $user */
    protected User $user;

    /**
     * @param LinkGeneratorBuilderService $linkGeneratorBuilderService
     * @param User $user
     */
    public function __construct(LinkGeneratorBuilderService $linkGeneratorBuilderService, User $user)
    {
        $this->linkGeneratorBuilderService = $linkGeneratorBuilderService;
        $this->user = $user;
    }

    /**
     * @return Renderable
     */
    public function view(): Renderable
    {
        return view('auth.register');
    }

    /**
     * @param array $data
     * @return ContractsValidator
     */
    protected function validator(array $data): ContractsValidator
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]+$/', 'unique:users'],
        ]);
    }

    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data): User
    {
        return $this->user->create([
            'user_name' => $data['user_name'],
            'phone_number' => $data['phone_number'],
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->linkGeneratorBuilderService->createLink()->storeLink($user->id);

        Auth::login($user);

        return redirect()->route('link', ['link' => $this->linkGeneratorBuilderService->getLink()]);
    }
}

