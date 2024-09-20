@props(['active' => false ])

<a {{ $attributes }} class="{{$active ? 'text-white font-balsamiq font-bold text-2xl tracking-wide':'text-white font-balsamiq font-normal hover:font-bold text-2xl tracking-wide'}}" aria-current="{{ $active ? 'page':false}}">{{ $slot }}</a>