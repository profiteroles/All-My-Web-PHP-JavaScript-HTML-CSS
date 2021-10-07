
    <x-setting heading="Publish New Post">
        <form action="/admin/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="slug"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>
            <x-form.input name="thumbnail" type="file"/>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" required>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}"
                            {{old('category_id') == $cat->id ? 'selected': ''}}
                        >{{ucwords($cat->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
