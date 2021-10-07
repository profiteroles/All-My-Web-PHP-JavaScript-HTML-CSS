@props(['name','required'=>'required'])

<x-form.field>
    <x-form.label name="{{ $name }}"/>

    <input class="border border-gray-200 p-2 w-full rounded"
           name="{{ $name }}"
           id="{{ $name }}"
        {{ $attributes(['value' => old($name)]) }}
        {{$required}}>

    <x-form.error name="{{ $name }}"/>
</x-form.field>
