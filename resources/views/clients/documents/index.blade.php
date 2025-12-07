@extends('layouts.admin')

@section('title',  $client->nom_complet.' Gestion des Documents')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Documents pour {{ $client->nom_complet }}</h2>
        </div>
    </div>

    <div class="row">
        @foreach($templates as $code => $nom)
        @if($nom!='')
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $nom }}</h5>
                    <a href="{{ route('clients.documents.create', [$client, $code]) }}" 
                       class="btn btn-primary mt-2">
                        Créer ce document
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection