<?php

use Modules\Booking\Models\Booking;
use Modules\Offer\Models\OfferBooking;
use Modules\Ticket\Models\Ticket;
use Carbon\Carbon;

if (!function_exists('latest')) {
    function latest($path)
    {
        try {
            $version = file_get_contents(base_path('AssetsVersion'));
        } catch (\Exception $exception) { $version = 1; }
        $parts = parse_url($path);

        $query = [];
        if(isset($parts['query']))
            parse_str($parts['query'], $query);

        $query['v'] = trim($version);
        $url = $parts['path'] .= '?' . http_build_query($query);
        if(isset($parts['fragment']))
            $url .= '#'.$parts['fragment'];
        return $url;
    }
}

if (!function_exists('paginate')) {
    function paginate($collection)
    {
        return [
            'pagination' => [
                'total' => $collection->total(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage(),
                'from' => $collection->firstItem(),
                'to' => $collection->lastItem()
            ],
            'data' => $collection
        ];
    }
}


if (!function_exists('field')) {
    function field($type, $name, $label, $cols, $form = null, $options = [], $required = false, $multiple = false)
    {
        return [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'cols' => $cols,
            'form' => $form,
            'options' => $options,
            'required' => $required,
            'multiple' => $multiple,
        ];
    }
}


if (!function_exists('registeredModules')) {
    function registeredModules()
    {
        return [
            'Country',
            'Setting',
            'Doctor',
            'Lead',
            'Service',
            'Offer',
            'Branche',
            'Specificity',
            'Booking',
            'Blog',
            'Comment',
            'Ticket',
            'Partner',
            'Department',
            'Job',
            'Slider',
            'Testimonial',
            'Video',
            'Discount',
            // Pages Module order here should be the last (WildCarding)
            'Page',
            'Casing',
        ];
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return new \Modules\Setting\Services\SettingService();
    }
}


if (!function_exists('direction')) {
    function direction($locale)
    {
        if (app()->getLocale() == 'ar') {
            return 'rtl';
        } else return 'ltr';
    }
}


if (!function_exists('trunc')) {
    function trunc($str, $chars, $toSpace, $replacement = "...")
    {
        if ($chars > strlen($str)) return $str;

        $str = substr($str, 0, $chars);
        $spacePos = strrpos($str, " ");
        if ($toSpace && $spacePos >= 0)
            $str = substr($str, 0, strrpos($str, " "));

        return ($str . $replacement);
    }
}

function _getoptionColor($case)
{
    if ($case < 50) {

        $color = '#ff0000';
    } elseif ($case >= 50 && $case <= 70) {

        $color = '#ff8f16';
    } else {

        $color = '#2bc155';
    }

    return $color;

}

/**
 * Count of Booking in month.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _bookingMonthlyCount($status)
{
    $monthlyCount = Booking::where('sent', $status)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
    return $monthlyCount ? $monthlyCount : '0';
}

/**
 * Count of Booking in Weekly.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _bookingWeeklyCount($status)
{
    $weeklyCount = Booking::where('sent', $status)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    return $weeklyCount ? $weeklyCount : '0';
}

/**
 * Count of Booking in day.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _bookingDayCount($status)
{
    $dayCount = Booking::where('sent', $status)->whereDate('created_at', Carbon::today())->count();
    return $dayCount ? $dayCount : '0';
}

/**
 * Count of Offer_Booking in month.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingMonthlyCount($status)
{
    $monthlyOfferCount = OfferBooking::where('status', $status)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
    return $monthlyOfferCount ? $monthlyOfferCount : '0';
}

/**
 * Count of Offer_Booking in Weekly.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingWeeklyCount($status)
{
    $weeklyOfferCount = OfferBooking::where('status', $status)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    return $weeklyOfferCount ? $weeklyOfferCount : '0';
}

/**
 * Count of Offer_Booking in day.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingDayCount($status)
{
    $dayOfferCount = OfferBooking::where('status', $status)->whereDate('created_at', Carbon::today())->count();
    return $dayOfferCount ? $dayOfferCount : '0';
}


/**
 * Total Paid for Offer_Booking in month.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingMonthlyPaid()
{
    $monthlyOfferPaid = OfferBooking::join('offers', 'offers.id', '=', 'offer_bookings.offer_id')
        ->where('offer_bookings.status', 1)
        ->whereMonth('offer_bookings.created_at', date('m'))->whereYear('offer_bookings.created_at', date('Y'))
        ->groupBy('offers.id')
        ->get(['offers.id', DB::raw('sum(offers.price) as price')])
        ->sum('price');

    return $monthlyOfferPaid ? number_format($monthlyOfferPaid) : '0';
}

/**
 * Total Paid for Offer_Booking in Weekly.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingWeeklyPaid()
{
    $weeklyOfferPaid = OfferBooking::join('offers', 'offers.id', '=', 'offer_bookings.offer_id')
        ->where('offer_bookings.status', 1)
        ->whereBetween('offer_bookings.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->groupBy('offers.id')
        ->get(['offers.id', DB::raw('sum(offers.price) as price')])
        ->sum('price');

    return $weeklyOfferPaid ? number_format($weeklyOfferPaid) : '0';
}

/**
 * Total Paid for Offer_Booking in day.
 * @param $status 0 => painding | 1 => Confirmed | 2 => Not Confirmed
 * @return int
 */
function _offerbookingDayPaid()
{
    $dayOfferPaid = OfferBooking::join('offers', 'offers.id', '=', 'offer_bookings.offer_id')
        ->where('offer_bookings.status', 1)
        ->whereDate('offer_bookings.created_at', Carbon::today())
        ->groupBy('offers.id')
        ->get(['offers.id', DB::raw('sum(offers.price) as price')])
        ->sum('price');

    return $dayOfferPaid ? number_format($dayOfferPaid) : '0';
}

/**
 * get count of leads
 * @param array $status
 * @param string $topic
 * @return int value
 */

function _countOfLeads($topic = null)
{
    $count = Ticket::where('topic', $topic)->count();
    return ($count) ? $count : '0';
}

