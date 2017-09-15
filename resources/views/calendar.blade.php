@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>
        <hr>

        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <a href="{{ route('calendar', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}" class="button is-dark">
                        <span class="icon"><i class="fa fa-chevron-left"></i></span>
                    </a>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <h3 class="title is-3">{{ $current->format('F Y') }}</h3>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <a href="{{ route('calendar', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}" class="button is-dark">
                        <span class="icon"><i class="fa fa-chevron-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="full-calendar is-hidden-mobile">
            <div class="columns">
                <div class="column weekday">
                    <p class="has-text-centered">SUNDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">MONDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">TUESDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">WEDNESDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">THURSDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">FRIDAY</p>
                </div>
                <div class="column weekday">
                    <p class="has-text-centered">SATURDAY</p>
                </div>
            </div>
            @while ($ref->month <= $current->month)
                <div class="columns week">
                @for ($i = 0; $i < $ref::DAYS_PER_WEEK; $i++)
                    <div class="column day">
                        <div class="{{ $ref->month !== $current->month ? 'dim-date' : '' }}">
                            {{ $ref->day }}
                        </div>
                        @foreach ($events as $e)
                            @if ($e['start']->day === $ref->day and $e['start']->month === $ref->month)
                                @if ($e['allDay'])
                                    <span class="tag is-primary">{{ $e['title'] }}</span>
                                @else
                                    <span class="tag is-primary">{{ $e['start']->format('ga') }} {{ $e['title'] }}</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @php
                        $ref->addDay()
                    @endphp
                @endfor
                </div>
            @endwhile
        </div>
        <div class="is-hidden-tablet">
            @foreach ($events as $e)
                <h3 class="title is-3">{{ $e['title'] }}</h3>
                @if ($e['allDay'])
                    <h5 class="subtitle">{{ $e['start']->format('F jS') }}</h5>
                @else
                    <h5 class="subtitle">{{ $e['start']->format('F jS, g:ia') }}</h5>
                @endif
                @if ($e['detail'])
                    <h6 class="title is-6">{{ $e['detail'] }}</h6>
                @endif
                <hr>
            @endforeach
        </div>
    </div>
</section>

@endsection
