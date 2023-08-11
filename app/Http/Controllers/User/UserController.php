<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\FollowerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Stripe;

class UserController extends Controller
{
    /** @var UserService */
    private $userService;
    /** @var FollowerService */
    private $followerService;

    public function __construct(
        UserService $userService,
        FollowerService $followerService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->followerService = $followerService;
    }

    public function index(Request $request, string $username)
    {
        $user = $this->userService->findByUsername($username);
        $whoToFollow = $this->userService->findWhoToFollow();

        $data = [
            'user' => $user,
            'whoToFollow' => $whoToFollow
        ];

        return view('pages/user/index', $data);
    }

    public function subscribe(Request $request, string $username)
    {
        $userToSubscribe = $this->userService->findByUsername($username);

        $data = [
            'user' => $userToSubscribe
        ];

        return view('pages/user/subscribe', $data);
    }

    public function payment(Request $request, $username)
    {
        $user = $this->userService->findByUsername($username);

        if ($user != null) {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
                "amount" => 100 * 10,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Real Fans subscription for: ".$username
            ]);

            $this->followerService->subscribe($user);

            return redirect()->route('user-info', $username)
                ->with('message', 'Payment successful! You are now subscribed to '.$username);
        }

        return back()->withErrors([
            'error' => "User " . $username . " Not found!"
        ]);
    }
}
