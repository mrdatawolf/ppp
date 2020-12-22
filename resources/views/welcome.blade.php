@extends('layouts.main')
@section('content')
    <div class="grid grid-cols-6 gap-2">
        <div id="welcome_banner_1" class="row col-span-6 welcome_banners mb-8"><img class="hover:opacity-75" alt="image" src="{{ asset('img/1_ex.png') }}"></div>
        <div id="welcome_banner_1" class="row col-span-6 welcome_banners mb-8"><img class="hover:opacity-75" alt="image" src="{{ asset('img/2_ex.png') }}"></div>
        <div id="welcome_banner_1" class="row col-span-6 welcome_banners mb-8"><img class="hover:opacity-75" alt="image" src="{{ asset('img/3_ex.png') }}"></div>
        <div id="welcome_banner_1" class="row col-span-6 welcome_banners mb-8"><img class="hover:opacity-75" alt="image" src="{{ asset('img/4_ex.png') }}"></div>
        <div id="welcome_banner_4" class="row col-span-3 half_banners mb-8 bg-center bg-cover"><img class="hover:opacity-75" alt="image" src="{{ asset('img/1_half_ex.png') }}"></div>
        <div id="welcome_banner_4" class="row col-span-3 half_banners mb-8 bg-center bg-cover"><img class="hover:opacity-75" alt="image" src="{{ asset('img/2_half_ex.png') }}"></div>
        <div id="shop_by_brand" class="row col-span-6 text_breaks text-center h-20">Shop by Brand</div>
        @foreach(['Wind River' => 'img/picky-logo.png','HH' => 'img/picky-logo.png','SKECHERS' => 'img/picky-logo.png','Other' => 'img/picky-logo.png'] as $brand => $logo)
            <div class="brand bg-white rounded shadow border p-6 w-64 ml-6">
                <h5 class="text-3xl font-bold mb-4 mt-0">{{ $brand }}</h5>
                <p class="text-gray-700 text-sm"><img src="{{ asset($logo) }}"></p>
            </div>
        @endforeach
        <div id="shop_by_category" class="row col-span-6 text_breaks h-20 text-center">Shop by Category</div>
        @foreach(['Shoes' => 'img/picky-logo.png', 'Boots' => 'img/picky-logo.png', 'Jackets' => 'img/picky-logo.png', 'Masks' => 'img/picky-logo.png', 'Men\'s' => 'img/picky-logo.png', 'Women\'s' => 'img/picky-logo.png'] as $type => $logo)
            <div class="category bg-white rounded shadow border p-6 w-64 float-left ml-6">
                <h5 class="text-3xl font-bold mb-4 mt-0">{{ $type }}</h5>
                <p class="text-gray-700 text-sm"><img src="{{ asset($logo) }}"></p>
            </div>
        @endforeach
    </div>
@endsection
