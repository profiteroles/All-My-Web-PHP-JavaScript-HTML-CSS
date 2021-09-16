<div>
    <x-dropdown>
        <x-slot name="trigger">
            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left inline-flex">
                {{isset($currentCategory) ? ucwords($currentCategory->name): 'Categories'}}
                <x-down-arrow class=" absolute pointer-events-none"></x-down-arrow>
            </button>
        </x-slot>
        <x-dropdown-item href="/?{{http_build_query(request()->except('category','page'))}}"
                         :active="request()->routeIs('home')">All
        </x-dropdown-item>
        @foreach($categories as $cat)
            {{--"isset($currentCategory) && $currentCategory->is($cat)"--}}
            <x-dropdown-item href="/?category={{$cat->slug}}&{{http_build_query(request()->except('category','page'))}}"
                             :active='request()->is("categories/{{$cat->slug}}")'>{{ucwords($cat->name)}}</x-dropdown-item>
        @endforeach
    </x-dropdown>
</div>
