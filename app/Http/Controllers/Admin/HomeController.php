<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Associe;
use App\Models\Client;
use App\Models\Partenaire;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Quote;
use App\Models\QuoteInfo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:view user', ['only' => ['index']]);
        // $this->middleware('permission:create user', ['only' => ['userAdd','userStore']]);
        // $this->middleware('permission:update user', ['only' => ['userUpdate','userView']]);
        // $this->middleware('permission:delete user', ['only' => ['userDelete']]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /** home dashboard */
    public function index()
    {

        $appointments = Appointment::all();

        return view('dashboard.accueil', compact(
            'appointments',
        ));
    }




    public function BarChatQuotes()
    {
        $quotes = [];
        $quotes_status_pending = [];
        $quotes_status_processing = [];
        $quotes_status_completed = [];
        $quotes_status_cancelled = [];
        $months = [];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::create($currentYear, $currentMonth, 1)->subMonths($i);
            $monthName = $month->format('M Y');

            $quotes[] = QuoteInfo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $quotes_status_pending[] = QuoteInfo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereHas('latestStatus', function ($query) {
                    $query->where('quote_status', 'pending');
                })->count();

            $quotes_status_processing[] = QuoteInfo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereHas('latestStatus', function ($query) {
                    $query->where('quote_status', 'processing');
                })->count();

            $quotes_status_completed[] = QuoteInfo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereHas('latestStatus', function ($query) {
                    $query->where('quote_status', 'completed');
                })->count();

            $quotes_status_cancelled[] = QuoteInfo::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereHas('latestStatus', function ($query) {
                    $query->where('quote_status', 'cancelled');
                })->count();

            $months[] = $monthName;
        }

        $quotes = array_reverse($quotes);
        $quotes_status_pending = array_reverse($quotes_status_pending);
        $quotes_status_processing = array_reverse($quotes_status_processing);
        $quotes_status_completed = array_reverse($quotes_status_completed);
        $quotes_status_cancelled = array_reverse($quotes_status_cancelled);
        $months = array_reverse($months);

        Log::info([
            'quotes' => $quotes,
            'quotes_status_pending' => $quotes_status_pending,
            'quotes_status_processing' => $quotes_status_processing,
            'quotes_status_completed' => $quotes_status_completed,
            'quotes_status_cancelled' => $quotes_status_cancelled,
        ]);
        return response()->json([
            'quotes' => $quotes,
            'quotes_status_pending' => $quotes_status_pending,
            'quotes_status_processing' => $quotes_status_processing,
            'quotes_status_completed' => $quotes_status_completed,
            'quotes_status_cancelled' => $quotes_status_cancelled,
            'labels' => $months,
        ]);
    }

    public function PieChatQuotes()
    {
        $quotes_status_pending = QuoteInfo::whereHas('latestStatus', function ($query) {
            $query->where('quote_status', 'pending');
        })->count();

        $quotes_status_processing = QuoteInfo::whereHas('latestStatus', function ($query) {
            $query->where('quote_status', 'processing');
        })->count();

        $quotes_status_completed = QuoteInfo::whereHas('latestStatus', function ($query) {
            $query->where('quote_status', 'completed');
        })->count();

        $quotes_status_cancelled = QuoteInfo::whereHas('latestStatus', function ($query) {
            $query->where('quote_status', 'cancelled');
        })->count();


        return response()->json([
            'quotes_status_pending' => $quotes_status_pending,
            'quotes_status_processing' => $quotes_status_processing,
            'quotes_status_completed' => $quotes_status_completed,
            'quotes_status_cancelled' => $quotes_status_cancelled,
        ]);
    }





    /** profile user */
    public function userProfile()
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        return view('dashboard.profile', compact('users'));
    }
}
