@extends('admin.dashboard')

@section('page-title', 'Training Conducted')

@section('dashboard-content')
<?php use Illuminate\Support\Facades\Crypt; ?>
<div class="container">
    <div class="row">
        @livewire('conducted-training')
    </div>
</div>
@endsection

