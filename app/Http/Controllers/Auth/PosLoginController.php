<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\IncomeArchive;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect user after login
     * 
     * @var String
     */
    protected $redirectTo = RouteServiceProvider::PosView;

    /**
     * Show pos view login
     * @return \Illuminate\Http\Response
     */
    public function showPosLogin(){
        return view('pos/auth/open');
    }

    /**
     * Handle an incoming authentication request.
     *  
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function posLogin(Request $request)
    {
        $currentTimestamp = Carbon::now();

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $userCredentials = $request->only('username', 'password');

        // check user using auth function
        if (Auth::attempt($userCredentials)) {

            // create income archive
            try {
                DB::beginTransaction();
                $incomeArchive = new IncomeArchive([
                    'start_date' => $currentTimestamp,
                ]);
                $incomeArchive->save();
                // store session
                IncomeArchive::createIncomeArciveSession($incomeArchive->id);

            } catch(Exception $e) {
                DB::rollBack();
                return redirect()
                    ->intended(RouteServiceProvider::PosView)
                    ->with('error', 'Problem of occured while create income archive!');   
            }
            DB::commit();
            return redirect()->intended(RouteServiceProvider::PosView);

        }
        else {
            return back()->with('error', 'Whoops! invalid email or password.');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function posDestroy(Request $request)
    {
        $currentTimestamp = Carbon::now();

        // get income archive session id
        $incomeArchiveId = IncomeArchive::getIncomeArchiveSession();
        if(!$incomeArchiveId->data){
            return back()->with('error', $incomeArchiveId->message);
        }
        $incomeArchiveId = $incomeArchiveId->data;

        // get income archive record
        $incomeArchive = IncomeArchive::getIncomeArchive($incomeArchiveId);
        if(!$incomeArchive->data){
            return back()->with('error', $incomeArchive->message);
        }
        $incomeArchive = $incomeArchive->data;

        // close income archive
        try {
            DB::beginTransaction();
            $currentStaff = Auth::user();

            $totalRevenue = IncomeArchive::getTotalOrderRevenueExpenseNetIncome($incomeArchive->orders);

            $incomeArchive->end_date         = $currentTimestamp;
            $incomeArchive->staff            = $currentStaff->username;
            $incomeArchive->total_order_made = $incomeArchive->orders()->count();
            $incomeArchive->total_revenue    = $totalRevenue->totalRevenue;
            $incomeArchive->total_net_income = $totalRevenue->totalNetIncome;
            $incomeArchive->total_expense    = $totalRevenue->totalExpense;
            
            $incomeArchive->save();

            // clear income archive id from session
            IncomeArchive::clearIncomeArchiveSession();

        } catch(Exception $ex) {
            DB::rollBack();
            return back()
                ->with('error', 'Problem occured while trying to close the pos system, please contact us for the bugs!');
        }

        DB::commit();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pos-login');
    }

}
