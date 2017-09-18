<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Calendar extends Controller
{
    /**
     * @param  string $year
     * @param  string $month
     * @return \Illumainte\Http\Response
     */
    public function index($year = null, $month = null)
    {
        $title = 'Calendar of Events';
        $current = Carbon::createFromDate($year ?? date('Y'), $month ?? date('m'), 1, 'America/New_York');
        $nextMonth = new Carbon($current->copy()->addMonth());
        $prevMonth = new Carbon($current->copy()->addMonth(-1));
        $ref = (new Carbon($current->copy()))->subDays($current->dayOfWeek);
        $events = Event::byMonth($current);

        return view('calendar', compact(
            'title', 'current', 'nextMonth', 'prevMonth', 'ref', 'events'
        ));
    }
}
