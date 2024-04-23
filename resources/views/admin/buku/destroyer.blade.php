<form onsubmit="return confirm('Apakah Anda Yakin ?');"
    action="{{ route('post.destroy', $post->id) }}" method="POST">
    <a href="{{ route('post.edit', $post->id) }}"
        class="btn btn-sm btn-info shadow">Edit</a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger shadow">Delete</button>
</form>
