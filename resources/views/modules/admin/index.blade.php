@extends('modules.admin.master')
@section('dashboard', 'open')
@section('content')
<section class="wrapper main-wrapper" style="">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">Dashboard</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href=""><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="">Dashboard</a>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="my-card work">
                                <div class="img-section song">
                                    <img src="https://i.postimg.cc/B6tXsrKz/image.png" alt="">
                                </div>
                                <div class="card-desc ">
                                    <div class="card-header">
                                        <div class="card-title">Song</div>
                                    </div>
                                    <div class="card-time">{{ $songs->count() }}</div>
                                    <a href="{{ route('admin.songs.all') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="my-card work">
                                <div class="img-section genre">
                                    <img src="https://i.postimg.cc/SNs5pqD4/image.png" alt="">
                                </div>
                                <div class="card-desc  ">
                                    <div class="card-header">
                                        <div class="card-title">Genre</div>
                                    </div>
                                    <div class="card-time">{{ $genres->count() }}</div>
                                    <a href="{{ route('admin.songs.all') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="my-card work">
                                <div class="img-section album">
                                    <img src="https://i.postimg.cc/tJ10qjpY/image.png" alt="">
                                </div>
                                <div class="card-desc  ">
                                    <div class="card-header">
                                        <div class="card-title">Album</div>
                                    </div>
                                    <div class="card-time">{{ $albums->count() }}</div>
                                    <a href="{{ route('admin.songs.all') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="my-card work">
                                <div class="img-section artist">
                                    <img src="https://i.postimg.cc/gcT9jnwj/image.png" alt="">
                                </div>
                                <div class="card-desc ">
                                    <div class="card-header">
                                        <div class="card-title">Artist</div>
                                    </div>
                                    <div class="card-time">{{ $artists->count() }}</div>
                                    <a href="{{ route('admin.songs.all') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <section class="col-lg-7">
                            <div class="card my-4 bg-gradient-success">
                                <div class="card-header border-0">

                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Calendar
                                    </h3>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                            </div>
                        </section>
                        <section class="col-lg-5">
                            <div class="card my-4">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ion ion-clipboard mr-1"></i>
                                        To Do List
                                    </h3>

                                    <div class="card-tools">
                                        <div class="card-tools">
                                            {{-- {{ $tasks->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="todo-list">
                                        @if (!count($tasksWithRelativeTime))

                                        @else
                                        @foreach ($tasksWithRelativeTime as $task)
                                            <li id="todo-{{ $task['task']->id }}"
                                                class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="icheck-primary d-inline ml-2">
                                                        <input @if ($task['task']->completed) checked @endif
                                                        type="checkbox" value="" name="todo[]"
                                                        id="{{ $task['task']->id }}">
                                                    </div>
                                                    <label @if ($task['task']->completed) style="text-decoration:
                                                        line-through;" @endif
                                                        for="{{ $task['task']->id }}"
                                                        class="text">{{ $task['task']->title }}</label>
                                                    <small for="{{ $task['task']->id }}" @if ($task['task']->completed)
                                                        style="text-decoration: line-through;" @endif
                                                        class="badge @if (!$task['task']->completed) badge-danger @endif"><i
                                                            class="far fa-clock"></i>
                                                        {{ $task['relative_time'] }}</small>
                                                </div>
                                                <div style="cursor: pointer;" class="tools">
                                                    @if (!$task['task']->completed)
                                                    <i data-id="{{ $task['task']->id }}" class="ri-edit-line mr-2"></i>
                                                    @endif
                                                    <i data-id="{{ $task['task']->id }}" class="ri-delete-bin-line"></i>
                                                </div>
                                            </li>
                                        @endforeach
                                        @endif
                                        {{ $tasks->links() }}
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <form style="height:40px;" action="{{ route('admin.add-todo') }}" method="POST"
                                        class="d-flex justify-content-between">
                                        @csrf
                                        <div style="flex-grow: 1;;height:100%" class="">
                                            <input style="width:100%; height:100%;padding: 0 16px" type="text"
                                                name="title">
                                        </div>

                                        <button style="height:100%" type="submit"
                                            class="btn btn-info btn-submit-add ml-2 d-flex align-items-center"><i
                                                class="fas fa-plus me-2"></i>Add
                                            item</button>
                                    </form>

                                </div>
                            </div>
                        </section>
                    </div>
            </section>
        </section>
    </div>
</section>
<script>
    $(document).ready(function() {
            let todoList = $('.todo-list');
            let btn = $('button[type="submit"]');
            let inputElement = $('input[name="title"]');
            let dataId = '';
            $(todoList).on('click', '.ri-delete-bin-line', function() {
                let dataId = $(this).data('id');
                if (window.confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        type: "post",
                        url: "admin/delete-todo/" + dataId,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#todo-' + dataId)
                                .remove();
                        }
                    });
                }
            });

            $(todoList).on('click', '.ri-edit-line', function() {
                dataId = $(this).data('id');
                $(btn).removeClass('btn-submit-add').addClass('btn-submit-edit');
                $('.btn-submit-edit').html(
                    `
                <i style="font-size:14px;" data-id="" class="ri-edit-line mx-2"></i>Edit item`
                );
                let itemEdit = $('label[for=' + dataId + ']');
                inputElement.val(itemEdit.html());
            })

            $('form').submit(function(event) {
                event.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                if ($(btn).hasClass('btn-submit-edit')) {
                    $.ajax({
                        type: "post",
                        url: "admin/update-todo/" + dataId,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $(btn).removeClass('btn-submit-edit').addClass('btn-submit-add');
                            $('.btn-submit-add').html(
                                `<i class="fas fa-plus mr-2"></i>Add item`);
                            inputElement.val('');
                            let label = $('label[for=' + dataId + ']').text(response.task
                                .title);
                        }
                    });
                } else if ($(btn).hasClass('btn-submit-add')) {
                    let url = form.attr('action');
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            let task = response.task;
                            let time = response.tasksWithRelativeTime;
                            inputElement.val('');
                            let newItem = `<li id="todo-${task.id}">
                                    <div class="icheck-primary d-inline ml-2">
                                        <input ${task.completed ? 'checked' : ''} type="checkbox" value="" name="todo[]" id="${task.id}">
                                        <label ${task.completed ? 'style="text-decoration: line-through;"' : ''} for="${task.id}" class="text">${task.title}</label>
                                        <small for="${task.id}" ${task.completed ? 'style="text-decoration: line-through;"' : ''} class="badge ${!task.completed ? 'badge-danger' : ''}"><i class="far fa-clock"></i> 1 second before</small>
                                        <div style="cursor: pointer;" class="tools">
                                        <i data-id="${task.id}" class="ri-edit-line mr-2"></i>
                                        <i data-id="${task.id}" class="ri-delete-bin-line"></i>
                                        </div>
                                    </div>
                                    </li>`;

                            todoList.prepend(newItem);
                            todoList.find("li").last().remove();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                let errors = JSON.parse(xhr.responseText);
                                $.each(errors.errors, function(field, messages) {
                                    let inputElement = $('input[name="' + field + '"]');
                                    let formGroupElement = inputElement.closest(
                                        '.form-group');
                                    formGroupElement.addClass('has-error');
                                    formGroupElement.find('.invalid-feedback').remove();
                                    $.each(messages, function(index, message) {
                                        formGroupElement.append(
                                            '<div style="display:block;" class="invalid-feedback">' +
                                            message + '</div>');
                                    });
                                });
                            }
                        }
                    });
                };
            });

            $('body').on('change', 'input[name="todo[]"]', function(event) {
                let inputId = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.change-status-todo', [':id']) }}".replace(':id',
                        inputId),
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        let task = response.task;
                        let label = $('label[for=' + inputId + ']');
                        let smallTime = $('small[for=' + inputId + ']');
                        let edit = $('.ri-edit-line[data-id="' + inputId + '"]');
                        if (task.completed) {
                            label.addClass('text-decoration-line-through');
                            smallTime.addClass('text-decoration-line-through');
                            smallTime.removeClass('badge-danger');
                            edit.addClass('display-none');
                        } else {
                            label.removeClass('text-decoration-line-through');
                            smallTime.removeClass('text-decoration-line-through');
                            smallTime.addClass('badge-danger');
                            edit.removeClass('display-none');
                        }
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    right: 'prev,next today',
                    center: 'title',
                    left: ''
                },
                navLinks: true,
                editable: true,
                selectable: true,
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '{{ route('admin.get-event') }}',
                        dataType: 'json',
                        success: function(response) {
                            let events = [];
                            $.each(response, function(key, event) {
                                events.push({
                                    id: event.id,
                                    title: event.title,
                                    start: event.start,
                                    end: event.end,
                                    allDay: event.allDay
                                });
                            });
                            successCallback(events);
                        },
                        error: function() {
                            failureCallback();
                        }
                    });
                },
                displayEventTime: false,
                eventContent: function(arg) {
                    return arg.event.title;
                },
                select: function(date) {
                    let title = prompt('Event Title:');
                    if (title) {
                        let start_date = date.startStr;
                        let end_date = date.endStr;
                        $.ajax({
                            url: "{{ route('admin.create-event') }}",
                            type: "POST",
                            data: {
                                title: title,
                                start: start_date,
                                end: end_date,
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                alert('Add successfully');
                                calendar.refetchEvents();
                            }
                        })
                    }
                },
                eventClick: function(val) {
                    const dialog = $('<dialog>');
                    let event = val.event;
                    let start = moment(event.start).format('DD-MM-YYYY');
                    let end = moment(event.end).subtract(1, 'day').format('DD-MM-YYYY');

                    dialog.html(
                        `
                            <section class="box">
                                <header class="panel_header">
                                    <h2 class="title pull-left">Event:</h2>
                                </header>
                                <div class="content-body">
                                    <div class="row">
                                                <div class="form-group">
                                                    <p>From ${start} to ${end}</p>
                                                    <span>${event.title}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <button class="btn-dialog btn-edit-event">
                                                        <p class="paragraph"> Edit </p>
                                                        <span class="icon-wrapper">
                                                        <i class="ri-edit-line"></i>
                                                        </span>
                                                    </button>
                                                    <button class="btn-dialog btn-delete-event mx-3">
                                                        <p class="paragraph"> Delete </p>
                                                        <span class="icon-wrapper">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </span>
                                                    </button>
                                                    <button class="btn-dialog btn-cancel-event">
                                                        <p class="paragraph"> Cancel </p>
                                                        <span class="icon-wrapper">
                                                            <i class="ri-arrow-go-back-line"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                    </div>
                                </div>
                            </section>
                            `
                    )
                    $('body').append(dialog);
                    dialog.get(0).showModal();

                    $('.btn-delete-event').on('click', function() {
                        let eventId = event.id;
                        if (confirm('Are you sure you want to delete this event?')) {
                            $.ajax({
                                url: "{{ route('admin.delete-event', [':id']) }}"
                                    .replace(':id', eventId),
                                type: "get",
                                success: function(response) {
                                    dialog.get(0).close();
                                    calendar.refetchEvents();
                                }

                            })
                        }
                    })

                    $('.btn-edit-event').on('click', function() {
                        dialog.get(0).close();
                        let start = moment(event.start).format('YYYY-MM-DD');
                        let end = moment(event.end).subtract(1, 'day').format('YYYY-MM-DD');
                        let eventTitle = event.title;
                        let eventId = event.id;
                        const newDialog = $('<dialog>');
                        newDialog.html(
                            `
                                <form action="{{ route('admin.update-event', [':id']) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <section class="box">
                                        <header class="panel_header">
                                            <h2 class="title pull-left">Edit Event:</h2>
                                        </header>
                                        <div class="content-body">
                                            <div class="form-date d-flex">
                                                <div class="form-group me-2">
                                                    <label class="form-label">Date Start</label>
                                                    <span class="desc"></span>
                                                    <div class="controls">
                                                        <input type="date" name="start" value="${start}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Date End</label>
                                                    <span class="desc"></span>
                                                    <div class="controls">
                                                        <input type="date" name="end" value="${end}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Event Title</label>
                                                <span class="desc"></span>
                                                <div class="controls">
                                                    <input type="text" name="title" value="${eventTitle}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="text-right d-flex">
                                                <input class="btn btn-primary btn-submit" type="submit" value="Save">
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            `.replace(':id', eventId)
                        )
                        $('body').append(newDialog);
                        newDialog.get(0).showModal();

                    })

                    $('.btn-cancel-event').on('click', function() {
                        dialog.get(0).close();
                    })

                }
            });
            calendar.render();
        });
</script>

@endsection