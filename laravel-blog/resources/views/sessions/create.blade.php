@extends("components.layout")
@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-8">
        <h1 class="text-center font-bold text-lx">Register</h1>
        <form action="/login" method="POST" class="mt-10">
        @csrf
        <!-- Email -->
            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="email">
                    Email
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="email"
                       name="email"
                       id="email"
                       value="{{old('password')}}"
                       required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <!-- Password -->
            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="password">
                    Password
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="password"
                       name="password"
                       id="password"
                       required>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Login</button>
            </div>
            @if($errors->any())
                <lu>
                    @foreach($errors->all() as $err)
                        <li class="text-red-500 text-xs">{{$err}}</li>
                    @endforeach
                </lu>
            @endif
        </form>
    </main>
@endsection
