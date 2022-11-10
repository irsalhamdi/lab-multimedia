<?php

namespace App\Http\Controllers\Auth;

use App\Models\Contact;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Lupa Password';

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        return view('auth.forgot-password', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
