<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{

    /**
     * Supported social providers
     *
     * @var array
     */
    protected $providersList = ['twitter'];

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

    
    /**
     * Redirect user to social provider login page
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request, $provider)
    {
        // Redirect if social provider is not supported
        if (! in_array($provider, $this->providersList)) {
            abort('404');
        }

        // Hold the previous url to redirect back after auth
        $request->session()->flash('afterAuthUrl', url()->previous());

        return Socialite::driver($provider)->redirect();
    }


    public function callback(Request $request, $provider)
    {        

        try {
            $socialUser = Socialite::driver('twitter')->user();
        } catch (\Throwable $th) {
            abort(403);
        }


        /*
         * Check if this social account exists
         */
        $checkSocialAccount = SocialAccount::where([
            ['provider', $provider],
            ['provider_user_id', $socialUser->getId()]
        ])->first();

        if ($checkSocialAccount) {
            // Get the user who owns this social account
            $user = $checkSocialAccount->user;

            // Login user and redirect
            Auth::login($user, true);
            return redirect( $request->session()->get('afterAuthUrl') );
        }


        /*
         * Check if there is a user with the same email
         */
        $checkUser = User::where('email', $socialUser->getEmail())->first();

        if ($checkUser) {
            // Create social account for the user
            $checkUser->socialAccounts()->create([
                'provider' => $provider,
                'provider_user_id' => $socialUser->getId()
            ]);

            // Login user and redirect
            Auth::login($checkUser);
            return redirect( $request->session()->get('afterAuthUrl') );
        }


        /*
         * Create new user and social account
         */
        $user = User::create([
            'email' => $socialUser->getEmail(),
            'username' => $socialUser->getNickname()
        ]);

        // Update user's profile
        $user->profile()->update([
            'name' => $socialUser->getName()
        ]);

        // Create social account
        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId()
        ]);

        // Login user and redirect
        Auth::login($user, true);
        return redirect( $request->session()->get('afterAuthUrl') );

    }
}
