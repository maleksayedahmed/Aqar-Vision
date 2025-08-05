<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginWithPhoneController extends Controller
{
    /**
     * Find the user by phone, generate and send an OTP.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        // 1. Validate that the phone number exists in the database.
        $request->validate([
            'phone' => ['required', 'string', 'exists:users,phone'],
        ], [
            'phone.exists' => 'رقم الهاتف هذا غير مسجل لدينا.',
        ]);

        // 2. Find the user associated with the phone number.
        $user = User::where('phone', $request->phone)->firstOrFail();

        // 3. Generate a 4-digit OTP to match the frontend inputs.
        $otp = rand(1000, 9999);

        // 4. Store the OTP and phone number in the session for the next step (verification).
        $request->session()->put([
            'otp' => $otp,
            'phone_for_verification' => $user->phone,
        ]);

        // 5. TODO: Implement your actual SMS sending logic here.
        //    This is where you would integrate with a service like Twilio, Mobily, etc.
        //    Example: SMSService::send($user->phone, "Your OTP is: " . $otp);

        // 6. Flash a session variable to signal the frontend to show the OTP modal.
        $request->session()->flash('show_otp_modal', true);
        
        // 7. Redirect back with a status message. For testing, we include the OTP in the message.
        //    In production, you would remove ` ' . $otp`.
        return back()->with('status', 'تم إرسال رمز التحقق (للتجربة: ' . $otp . ')');
    }

    /**
     * Verify the submitted OTP and log the user in.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        // 1. Validate the incoming OTP is a 4-digit string.
        $request->validate([
            'otp' => ['required', 'string', 'digits:4'],
        ]);

        // 2. Check if the required data exists in the session. If not, the request is invalid or has expired.
        if (!$request->session()->has('otp') || !$request->session()->has('phone_for_verification')) {
            return back()->withErrors(['otp' => 'انتهت صلاحية الجلسة، يرجى طلب رمز جديد.']);
        }

        // 3. Compare the submitted OTP with the one stored in the session.
        if ($request->otp != $request->session()->get('otp')) {
            throw ValidationException::withMessages([
                'otp' => 'رمز التحقق الذي أدخلته غير صحيح.',
            ]);
        }

        // 4. If the OTP is correct, find the user and log them in.
        $user = User::where('phone', $request->session()->get('phone_for_verification'))->firstOrFail();
        Auth::login($user);

        // 5. Clean up the session data after successful login.
        $request->session()->forget(['otp', 'phone_for_verification', 'show_otp_modal']);
        $request->session()->regenerate();

        // 6. Redirect the user to the homepage.
        return redirect()->route('home');
    }
}