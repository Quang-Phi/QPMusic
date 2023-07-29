@extends('modules.home.master')

@section('li_2','active')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/2S18MvW7/event.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">Music <span class="text-primary">Genres</span></h3>
        </div>
        <div class="row g-4 genre-list">
            @if ($genres->isEmpty())
            <p>No Genre Available</p>
            @else
            @foreach ($genres->take(8) as $item)
            @php
            $img = $item->img_url == null || !file_exists(public_path('img/genre/' . $item->img_url)) ? $item->img_url :
            asset('img/genre/' . $item->img_url);
            @endphp
            <div class="col-xl-3 col-sm-6 genre-item">
                <div class="cover cover--round">
                    <a href="{{ route('home.genre-details', ['id' => $item->id]) }}" class="cover__image"><img
                            src="{{ $img }}" alt="Remix">
                        <div class="cover__image__content"><span
                                class="capitalize cover__title mb-1 fs-6 text-truncate">{{ $item->name }}</span>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        @if ($genres->count() > 8)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="genre" data-limit="16" data-quantity="8" data-load="genre"
                class="btn btn-primary btn-load-more">
                <div class="btn__wrap">
                    <i class="ri-loader-3-fill"></i> <span>Load more</span>
                </div>
            </a>
        </div>
        @endif
    </div>
</div>

@endsection