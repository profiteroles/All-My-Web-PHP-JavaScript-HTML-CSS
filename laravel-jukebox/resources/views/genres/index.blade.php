<?php
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($genres as $genre)
                            <li class="mb-3 p-3 border sm:rounded-lg border-gray bg-blue-800 text-white hover:bg-black ">
                                <a href="{{url('/genres', ["id"=>$genre-> id])}}">
                                    {{$genre->name}}
                                </a></li>
                        @endforeach
                    </ul>
{{--                    <p class="text-gray-800">{{$genreCount}} genres on file.</p>--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
