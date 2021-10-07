
    <x-setting :heading="'Edit Post: '. $post->title">
        <form action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title',$post->title)"/>
            <x-form.input name="slug" :value="old('slug',$post->slug)"/>
            <x-form.textarea name="excerpt">{{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body',$post->body)}}</x-form.textarea>
            <div class="flex mt-6">
                <img src="{{asset('storage/'.$post->thumbnail)}}" alt="'img-'{{$post->slug}}" width="100" class="rounded-xl mr-6">
                <div class="flex-1">
                    <x-form.input required=" " name="thumbnail" type="file" :value="old('thumbnail',$post->thumbnail)"/>
                </div>
            </div>
            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" required>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}"
                            {{old('category_id',$post->category->id) == $cat->id ? 'selected': ''}}
                        >{{ucwords($cat->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
