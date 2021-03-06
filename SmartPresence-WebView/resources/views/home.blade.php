@extends('layouts.app')

@section('pageTitle', 'Home')

@section('content')
    <div style="min-height: 80vh">
        <div class="jumbotron jumbotron-og jumbotron-fluid text-center">
            @if (Auth::user()->role != 'admin')
                <h1 class="display-4" style="font-weight: bolder">CLASSES</h1>
            @endif
            @if (Auth::user()->role == 'admin')
                <h1 class="display-4" style="font-weight: bolder">MENU</h1>
            @endif
        </div>
        <div class="container">

            @if (Auth::user()->role != 'admin')

                @if ($classes->isEmpty())
                    @if (Auth::User()->role == 'mahasiswa')
                        <h1 class="text-danger text-center font-weight-bold" style="margin-top: 8rem">
                            You dont have any class enrolled.
                        </h1>
                        <p class="text-center font-weight-bold">Please go to <a href="{{ url('/allclass') }}">All
                                Class</a>
                            page to enroll a class.</p>
                    @endif
                    @if (Auth::User()->role == 'dosen')
                        <h1 class="text-danger text-center font-weight-bold" style="margin-top: 8rem">
                            You dont have any class.
                        </h1>
                        <p class="text-center font-weight-bold">Please add a class by clicking the button below.</p>
                    @endif
                @endif

                <div class="form-row">
                    @foreach ($classes as $class)
                        <div class="col-lg-4 my-2">
                            <div class="border shadow-sm rounded">
                                <a href="/class/{{ $class->class->id }}" class="text-decoration-none text-dark">
                                    @if ($class->class->image == 'empty')
                                        <div class="w-100 rounded-top"
                                            style="height: 10rem; background-image:url({{ asset('img/class_default.png') }}); background-size:cover">
                                        </div>
                                    @else
                                        <?php $image = $class->class->image; ?>
                                        <div class="w-100 rounded-top"
                                            style="height: 10rem; background-image:url({{ asset("img/class_image/$image") }}); background-size:cover">
                                        </div>
                                    @endif
                                    <div class="w-100 p-3" style="min-height: 10rem">
                                        <h5 class="card-title">{{ $class->class->name }}</h5>
                                        <p class="card-text">{{ $class->class->timedesc }}</p>
                                    </div>
                                </a>
                                <div class="w-100">
                                    @if (Auth::user()->role == 'dosen')
                                        <div class="btn-group w-100">
                                            <a href="/class/{{ $class->class->id }}/editClass" class="btn btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger rounded-right" data-toggle="modal"
                                                data-target="#exampleModal{{ $class->id }}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $class->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Are you sure you want to delete<br>
                                                                {{ $class->class->name }}?
                                                            </h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">No</button>
                                                            <a class="btn btn-danger"
                                                                href="/{{ $class->class->id }}/delete">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (Auth::user()->role == 'dosen')
                        <div class="mt-4 text-center w-100">
                            <a class="btn btn-success" href="/addClass">Add Class</a>
                        </div>
                    @endif
                </div>
            @endif

            @if (Auth::user()->role == 'admin')
                <div data-aos="fade-up" class="form-row">

                    <div class="col-lg-4 my-2">
                        <div class="border border-primary shadow-sm rounded">
                            <a href="/userregistered/dosen" class="text-decoration-none text-dark">
                                <div class="w-100 rounded-top"
                                    style="height: 10rem; background-image:url({{ asset('img/class_default.png') }}); background-size:cover">
                                </div>
                                <div class="w-100 p-3 d-flex align-items-center border-top border-primary"
                                    style="min-height: 10rem">
                                    <div class="w-100">
                                        <p class="card-title text-center text-primary font-weight-bold">Registered</p>
                                        <h1 class="card-title text-center text-primary font-weight-bold">Dosen</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 my-2">
                        <div class="border border-info shadow-sm rounded">
                            <a href="/userregistered/mahasiswa" class="text-decoration-none text-dark">
                                <div class="w-100 rounded-top"
                                    style="height: 10rem; background-image:url({{ asset('img/class_default.png') }}); background-size:cover">
                                </div>
                                <div class="w-100 p-3 d-flex align-items-center border-top border-info"
                                    style="min-height: 10rem">
                                    <div class="w-100">
                                        <p class="card-title text-center text-info font-weight-bold">Registered</p>
                                        <h1 class="card-title text-center text-info font-weight-bold">Mahasiswa</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 my-2">
                        <div class="border border-danger shadow-sm rounded">
                            <a href="/classregistered" class="text-decoration-none text-dark">
                                <div class="w-100 rounded-top"
                                    style="height: 10rem; background-image:url({{ asset('img/class_default.png') }}); background-size:cover">
                                </div>
                                <div class="w-100 p-3 d-flex align-items-center border-top border-danger"
                                    style="min-height: 10rem">
                                    <div class="w-100">
                                        <p class="card-title text-center text-danger font-weight-bold">Registered</p>
                                        <h1 class="card-title text-center text-danger font-weight-bold">Classes</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>
@endsection
