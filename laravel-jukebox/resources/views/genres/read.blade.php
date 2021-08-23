<?php

/**
 * Filename: read.blade.php
 * Author: EROL A'NIL
 *
 */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres') }} {{$genre->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
{{--                    table>(thread>tr>th*2)+(tbody>tr*4>th+td)--}}
                    <table class="table w-full border-2 bg-white">
                        <thread class="bg-black text-gray-100">
                            <tr class="bg-black text-white">
                                <th class="text-left px-1 py-2 w-1/5">Item</th>
                                <th class="text-left px-1 py-2 w-4/5">Value</th>
                            </tr>
                        </thread>
                        <tbody>
                        <tr class="border border-0 border-b-1">
                            <th class="text-left px-1 py-2">ID</th>
                            <td class="text-left px-1 py-2">{{$genre->id}}</td>
                        </tr>
                        <tr class="border border-0 border-b-1">
                            <th class="text-left px-1 py-2">Name</th>
                            <td class="text-left px-1 py-2">{{$genre->name}}</td>
                        </tr>
                        <tr class="border border-0 border-b-1">
                            <th class="text-left px-1 py-2">Description</th>
                            <td class="text-left px-1 py-2">{{$genre->description}}</td>
                        </tr>
                        <tr class="border border-0 border-b-1">
                            <th class="text-left px-1 py-2">Icon</th>
                            <td class="text-left px-1 py-2">{{$genre->picture}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <p>TODO: Display List of Albums in this Genre</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
