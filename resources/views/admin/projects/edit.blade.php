@extends('layouts.app')

@section('content')

<div class="container mt-5 text-center">

    <a href="{{ route('admin.projects.index')}}" class="btn btn-dark">Torna alla Lista</a>

        <div class="my-5">

        <h1>Stai modificando il progetto: {{$project->title}}</h1>

<form action="{{ route('admin.projects.update' , $project)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="row justify-content-center my-5">

    <div class="col-6">
        <label for="title">Titolo</label>
        <input type="text" id="title" name="title" class="form-control" value=" {{ $project->title}}">
    </div>


    <div class="col-3">

        <label for="type_id">Tipo</label>
        <select class="form-select" id="type_id" name="type_id" class="form-select @error('type_id') is-invalid @enderror" >
            <option value="">Nessun tipo</option>
            
            @foreach ($types as $type)
            <option value="{{$type->id}}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>{{$type->label}}</option>
            @endforeach

          </select>
          {{-- non funziona --}}
          @error('type_id')
          <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

</div>

<div class="row justify-content-center my-5">

    <div class="col-4">
        <label for="date">Data</label>
        <input type="text" id="date" name="date" class="form-control" value=" {{ $project->date}}">
       
    </div>
    <div class="col-4">
        <label for="main_lang">Linguaggio</label>
        <select class="form-select" id="main_lang" name="main_lang">
            
            <option value="html" @if($project->main_lang == 'html') selected @endif >Html</option>
            <option value="js" @if($project->main_lang == 'js') selected @endif >Js</option>
            <option value="vite" @if($project->main_lang == 'vite') selected @endif >Vite</option>
            <option value="php" @if($project->main_lang == 'php') selected @endif >Php</option>
          </select>
       
    </div>
</div>



        {{-- cover img  --}}
        <div class="row justify-content-center my-5">
            <div class="col-6">
              <label for="img">Immagine</label>
              <input type="file" id="img" name="img" class="form-control @error('img') is-invalid @enderror" value="{{ old('img')}}" >
              @error('img')
              <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
          </div>
    
        </div>

<div class="row justify-content-center my-5">
    <div class="col-2">
        <label for="commit">Numero di commit</label>
        <input type="text" id="commit" name="commit" class="form-control"value=" {{ $project->commit}}" >
    </div>
    <div class="col-2">
        <label for="bonus">Bonus</label>
        <input type="text" id="bonus" name="bonus" class="form-control" value=" {{ $project->bonus}}">
    </div>
</div>

<div class="col-12 my-5">

          
    <p>Tecnologie</p>
      <div class="form-control form-check w-75 m-auto @error('technologies') is-invalid @enderror">
        
    <input type="checkbox" name="technologies[]" id="non-valido" value="-50" class="form-check-control">
    <label for="non-valido" class="me-3">XXX</label>
        @foreach ($technologies as $technology)
          
            <input type="checkbox" name="technologies[]" id="technology-{{$technology->id }}" value="{{ $technology->id }}" class="form-check-control" 
            @if (in_array($technology->id, old('technologies', $tech_ids))) checked @endif>               
           <label for="technology-{{$technology->id }}" class="me-3">{{ $technology->label }}</label>
      
        @endforeach
        

      </div>
      @error('technologies')
      <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror

  </div>




<button class="btn btn-dark">Salva</button>

</form>



@endsection