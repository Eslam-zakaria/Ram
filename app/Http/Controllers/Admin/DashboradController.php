<?php
namespace App\Http\Controllers\Admin;

use App\Constants\Statuses;
use App\Constants\BookingStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Offer\Models\OfferBooking;
use Carbon\Carbon;
class DashboradController extends Controller
{

    public function index()
    {
        //percentage of booking Monthly
        $bookingMonthlyPercent = Booking::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $monthly_equation = ($bookingMonthlyPercent / 5000) * 100 ;

        //percentage of booking Weekly
        $bookingWeeklyPercent = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $weekly_equation = ($bookingWeeklyPercent / 5000) * 100 ;

        //percentage of booking Day
        $bookingTodayPercent = Booking::whereDate('created_at', Carbon::today())->count();
        $daly_equation = ($bookingTodayPercent / 5000) * 100 ;

        //percentage of Offer_booking Monthly
        $offerbookingMonthlyPercent = OfferBooking::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $monthly_equation_offer = ($offerbookingMonthlyPercent / 10000) * 100 ;

        //percentage of Offer_booking Weekly
        $offerbookingWeeklyPercent = OfferBooking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $weekly_equation_offer = ($offerbookingWeeklyPercent / 10000) * 100 ;

        //percentage of Offer_booking Day
        $offerbookingTodayPercent = OfferBooking::whereDate('created_at', Carbon::today())->count();
        $daly_equation_offer = ($offerbookingTodayPercent / 10000) * 100 ;

        return view('admin.dashboard.index',compact('monthly_equation','weekly_equation','daly_equation','monthly_equation_offer','weekly_equation_offer','daly_equation_offer'));
    }
}