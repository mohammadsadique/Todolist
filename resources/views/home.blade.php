@extends('layouts.app')

@section('content')
<style type="text/css">
    .read-more-show{
      cursor:pointer;
      color: #ed8323;
    }
    .read-more-hide{
      cursor:pointer;
      color: #ed8323;
    }

    .hide_content{
      display: none;
    }
    .task_complete{
        text-decoration: line-through;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('addsuccess'))
                <div class="alert alert-success alert-dismissible">
                    <strong>Success!</strong> {{ session()->get('addsuccess') }}
                    <button type="button" class="close  pull-right" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
            <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addTodoModal">
                <i class="fa fa-plus"></i> Create Task
            </button>
            <div class="card">
                <div class="card-header">{{ __('Todo List') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <strong>Success!</strong> {{ session()->get('success') }}
                            <button type="button" class="close  pull-right" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif
                    <table  id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todoData as $data) 
                            <tr>
                                <td @if($data->status == 1) class="task_complete" @endif>
                                    <h3>{{ $data->title }}</h3>
                                    <p>
                                        @if(strlen($data->description) > 150)
                                            <!-- {!! substr($data->description,0,150) !!} -->
                                            <span>Test is too big....</span>
                                            <!-- <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span> -->
                                            <!-- <span class="read-more-content"> {{ substr($data->description,150,strlen($data->description)) }}  -->
                                            <!-- <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span> -->
                                        @else
                                            {!! $data->description !!}
                                        @endif
                                    </p>
                                </td>
                                <td style="width: 18%;text-align:center;">
                                    <input type="hidden" value="{{ $data->id }}" class="todolist_id">
                                    <input type="hidden" value="{{ $data->title }}" class="title">
                                    <input type="hidden" value="{{ $data->description }}" class="description">

                                    <div class="btn-group">
                                        <form action="{{ route('completeTodoList') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $data->id }}" name="todolist_id">
                                            @if($data->status == 1)
                                                <button type="submit" class="btn btn-dark mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Revert the task" onclick="return confirm('Are you sure you want to make revert this task back?')"><i class="fa fa-tasks"></i></button>
                                            @else 
                                                <button type="submit" class="btn btn-dark mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark task as completed" onclick="return confirm('Are you sure this task is completed?')"><i class="fa fa-tasks"></i></button>
                                            @endif
                                        </form>
                                    </div>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary mb-1 viewTask" data-bs-toggle="tooltip" data-bs-placement="top" title="View Task!" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></button>
                                    </div>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info mb-1 editTask" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Task!" data-toggle="modal" data-target="#editTodoModal"><i class="fa fa-pencil"></i></button>
                                    </div>

                                    <div class="btn-group">
                                        <form action="{{ route('deleteTodoList') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $data->id }}" name="todolist_id">
                                            <button type="submit" class="btn btn-danger mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Task!" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {!! $todoData->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-lg" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title"></h4>
            </div>
            <div class="modal-body">
                <p class="description"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-lg" id="addTodoModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Todo List</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <form action="{{ route('submitAddTodo') }}" method="post">
                @csrf 
                <input type="hidden" name="todolist_id" class="upd_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control upd_title" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <!-- <textarea class="form-control upd_description" rows="5" id="description" name="description"></textarea> -->
                        <textarea class="form-control upd_description" cols="80" id="editor2" name="description" rows="10" data-sample-short></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade modal-lg" id="editTodoModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Todo List</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <form action="{{ route('submitAddTodo') }}" method="post">
                @csrf 
                <input type="hidden" name="todolist_id" class="upd_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control upd_title" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <!-- <textarea class="form-control upd_description" rows="5" id="description" name="description"></textarea> -->
                        <textarea class="form-control upd_description" cols="80" id="editor3" name="description" rows="10" data-sample-short></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
