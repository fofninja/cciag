@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    var limit = 25;
    $("#liste").load("{{ route('bon_transfert.load', ['']) }}/" + limit);
    
    $("#showmore").click(function(){
        limit += 10;
        $('#loading-popup').show();
        $("#liste").load("{{ route('bon_transfert.load', ['']) }}/" + limit, function() {
            $('#loading-popup').hide();
        });
    });
});
</script>

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    <i class="fa fa-exchange"></i> LISTE DES TRANSFERTS
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        @if($message = Session::get('success'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div>
        @endif
        
        @if($message = Session::get('warning'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-warning">{{ $message }}</div>
        @endif
        
        @if($message = Session::get('error'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-danger">{{ $message }}</div>
        @endif
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px">
                    Transferts de Stock
                    <div class="pull-right">
                        <a href="{{ route('bon_transfert') }}" class="btn btn-rounded btn-sm btn-success" style="font-size:8px;">
                            <i class="fa fa-plus"></i> Nouveau Transfert
                        </a>
                        
                        <a href="{{ route('bon_transfert.historique') }}" class="btn btn-rounded btn-sm btn-info" style="font-size:8px;">
                            <i class="fa fa-history"></i> Historique
                        </a>
                    </div>
                </h5>
                
                <div id="liste"></div>
                <button id="showmore" data-page="2">Afficher plus</button>
            </div>
        </div>
        
        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Chargement...</p>
            </div>
        </div>
    </div>
</div>

@endsection