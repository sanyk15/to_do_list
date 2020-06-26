@extends('tasks.layout')

@section('content')
<!-- создание задачи -->
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('tasks.store') }}" method="POST" class="form-inline">
    @csrf
    <div class="form-group mx-sm-3 mb-2">
        <label for="input" class="sr-only">Text:</label>
        <input type="text" name="text" class="form-control" id="input" placeholder="Text">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Create</button>
</form>

<!-- текущие задачи -->
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <br>
    <tr>
        <th>Text</th>
        <th width="30px">Del</th>
    </tr>
    @foreach ($tasks as $task)
    <tr>
        <td>{{ $task->text }}</td>
        <td>
            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">X</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection