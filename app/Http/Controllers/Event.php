<?php

namespace App\Http\Controllers;

use App\Event as Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Event extends Controller
{
    /**
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Events';
        $events = Model::orderBy('start_date')->paginate(10);

        return view('admin.events.index', compact('title', 'events'));
    }

    /**
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $event = new Model(['start_date' => Carbon::now()]);
        $end_time = $event->end_date ? $event->end_date->format('H:m') : '';

        return view('admin.events.create', [
            'title' => 'New Event',
            'event' => $event,
            'start_time' => $event->start_date->hour . ':' . $event->start_date->minute,
            'end_time' => $end_time,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'detail' => ['max:255'],
            'start_date' => ['required', 'date_format:n/j/Y'],
            'start_time' => ['max:5'],
            'end_date' => ['nullable', 'date_format:n/j/Y', 'after_or_equal:start_date'],
            'end_time' => ['max:5'],
            'frequency' => ['nullable', 'in:DAILY,WEEKLY,MONTHLY'],
            'by_day' => ['nullable', 'in:' . implode(",", array_keys(config('custom.days')))],
            'interval' => ['nullable', 'integer'],
            'by_set_pos' => ['nullable', 'integer'],
            'until' => ['required_with:frequency'],
        ]);

        $event = $this->storeOrUpdateEvent(collect($attributes), new Model());

        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been successfully created.', $event->title));
    }

    /**
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $event)
    {
        $end_time = $event->end_date ? $event->end_date->format('H:i') : '';

        return view('admin.events.edit', [
            'title' => 'Modify Event',
            'event' => $event,
            'start_time' => $event->start_date->format('H:i'),
            'end_time' => $end_time,
        ]);
    }

    /**
     * @param  \App\Models\Event $event
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $event)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'detail' => ['max:255'],
            'start_date' => ['required', 'date_format:n/j/Y'],
            'start_time' => ['max:5'],
            'end_date' => ['nullable', 'date_format:n/j/Y', 'after_or_equal:start_date'],
            'end_time' => ['max:5'],
            'frequency' => ['nullable', 'in:DAILY,WEEKLY,MONTHLY'],
            'by_day' => ['nullable', 'in:' . implode(",", array_keys(config('custom.days')))],
            'interval' => ['nullable', 'integer'],
            'by_set_pos' => ['nullable', 'integer'],
            'until' => ['required_with:frequency'],
        ]);

        $event = $this->storeOrUpdateEvent(collect($attributes), $event);

        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been successfully updated.', $event->title));
    }

    /**
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been deleted.', $event->title));
    }

    /**
     * @param  \Illuminate\Support\Collection $attrs
     * @param  \App\Models\Event $model
     * @return \App\Models\Event
     */
    private function storeOrUpdateEvent(Collection $attrs, Model $model)
    {
        $model->title = $attrs->get('title');
        $model->detail = $attrs->get('detail');
        $model->start_date = new Carbon($attrs->get('start_date') . ' ' . $attrs->get('start_time'));

        if (!$attrs->get('start_time'))
            $model->all_day = true;

        if ($attrs->get('end_date'))
            $model->end_date = new Carbon($attrs->get('end_date') . ' ' . $attrs->get('end_time'));

        if ($attrs->get('frequency')) {
            $model->frequency = $attrs->get('frequency');
            $model->interval = $attrs->get('interval') ?: 1;
            $model->by_day = $attrs->get('by_day') ?: null;
            $model->by_set_pos = $attrs->get('by_set_pos') ?: null;
            $model->until = new Carbon($attrs->get('until'));
        }

        $model->save();

        return $model;
    }
}
