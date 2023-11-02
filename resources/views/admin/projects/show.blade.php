@extends('layouts.app')

@section('content')

<div class="container text-center">

    <a href="{{ route('admin.projects.index')}}" class="btn mt-5 btn-dark me-2">Torna alla lista</a>
    <a href="{{ route('admin.projects.edit', $project)}}" class="btn mt-5 btn-outline-dark">Modifica</a>
    <div class="my-5 border rounded w-50 m-auto p-4">
    <h1>{{$project->title}}</h1>

    <div class="row my-5">

        <div class="col-3">
            <img src="{{ asset('/storage/' . $project->img)}}" alt="" class="w-25">


        </div>
        <p><strong>ID: </strong>{{$project->id}}</p>
        <p><strong>Tipo: </strong>{{$project->type->label}}</p>
        <p><strong>Data: </strong>{{$project->date}}</p>
        <p><strong>Linguaggio: </strong>{{$project->main_lang}}</p>
        <p><strong>Numero di commit: </strong>{{$project->commit}}</p>
        <p><strong>Bonus: </strong>{{$project->bonus}}</p>
        <br><br><br>
        <p><strong>Creazione: </strong>{{$project->created_at}}</p>
        <p><strong>Modifica: </strong>{{$project->updated_at}}</p>
    </div>


    </div>
</div>


@endsection