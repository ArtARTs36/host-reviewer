<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repository\UserRepository;
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
final class AuthController extends Controller
{
    private $repository;

    /**
     * AuthController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function login(AuthRequest $request): RedirectResponse
    {
        $user = $this->repository->credentialsOr(function (string $login) {
            abort(422, "User with login '{$login}' not found! ");
        }, ...$request->onlyRulesValues());

        Auth::guard('web')->login($user, true);

        return redirect('/');
    }

    /**
     * @return View|RedirectResponse
     */
    public function auth()
    {
        if (!Auth::guest()) {
            return redirect('/');
        }

        return view('auth.page');
    }
}
