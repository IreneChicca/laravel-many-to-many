@extends('layouts.app')

@section('content')

<div class="container mt-5 text-center">

    <a href="{{ route('admin.projects.index')}}" class="btn btn-dark">Torna alla Lista</a>

        <div class="my-5">

        <h1>Aggiungi un nuovo progetto</h1>
        
            @if ($errors->any())
                
            
            <div class="alert alert-danger my-5 w-50 m-auto">
                Correggi i seguenti errori
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    
                </ul>

            </div>
            @endif
        <form action="{{ route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row justify-content-center my-5">

            <div class="col-6">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title')}}" >
                @error('title')
                <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            </div>

            <div class="col-3">

                <label for="type_id">Tipo</label>
                <select id="type_id" name="type_id" class="form-select  @error('type_id') is-invalid @enderror" >
                    <option value="">Nessun tipo</option>
                    
                    @foreach ($types as $type)
                    <option value="{{$type->id}}" @if (old('type_id') == $type->id) selected @endif>{{$type->label}}</option>
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
                <input type="text" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date')}}">
                @error('date')
                <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            </div>
            <div class="col-4">
                <label for="main_lang">Linguaggio</label>
                <select class="form-select @error('main_lang') is-invalid @enderror" id="main_lang" name="main_lang">
                    <option selected value="">Seleziona il linguaggio principale..</option>
                    <option value="html">Html</option>
                    <option value="js">Js</option>
                    <option value="vite">Vite</option>
                    <option value="php">Php</option>
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
                <input type="text" id="commit" name="commit" class="form-control @error('commit') is-invalid @enderror" value="{{ old('commit')}}">
                @error('commit')
                <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            </div>
            <div class="col-2">
                <label for="bonus">Bonus</label>
                <input type="text" id="bonus" name="bonus" class="form-control @error('bonus') is-invalid @enderror" value="{{ old('bonus')}}">
                @error('bonus')
                <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            </div>
        </div>

        <div class="col-12 my-5">

          
          <p>Tecnologie</p>
            <div class="form-control form-check w-75 m-auto @error('technologies') is-invalid @enderror">
              
          <input type="checkbox" name="technologies[]" id="non-valido" value="-50" class="form-check-control">
          <label for="non-valido" class="me-3">XXX</label>
              @foreach ($technologies as $technology)
                
                  <input type="checkbox" name="technologies[]" id="technology-{{$technology->id }}" value="{{ $technology->id }}" class="form-check-control" 
                  @if (in_array($technology->id, old('technologies', []))) checked @endif>               
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
</div>

    

</div>


@endsection