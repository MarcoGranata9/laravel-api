<form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger delete-btn" data-title="{{ $project->title }}"><i class="fa-solid fa-trash"></i></button>    
</form>