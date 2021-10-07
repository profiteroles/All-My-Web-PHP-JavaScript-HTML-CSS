@extends("components.layout")
@section('content')
    <main class="max-w-lg mx-auto mt-10">
        <x-panel>
            <h1 class="text-center font-bold text-lx">Register</h1>
            <form action="/register" method="POST" class="mt-10">
                @csrf
                <x-form.input name="name" type="text"/>
                <x-form.input name="username" type="text"/>
                <x-form.input name="email" type="email"/>
                <x-form.input name="password" type="password"/>
                <x-form.button>Submit</x-form.button>
                @if($errors->any())
                    <lu>
                        @foreach($errors->all() as $err)
                            <li class="text-red-500 text-xs">{{$err}}</li>
                        @endforeach
                    </lu>
                @endif
            </form>
        </x-panel>
    </main>
@endsection
