@extends('layouts.app')

@section('content')
    <template v-if="menu==0">
        <menu-principal></menu-principal>
    </template>

    <template v-if="menu==1">
        <h1 class="text-center">Presupuesto</h1>
    </template>

    <template v-if="menu==2">
        <h2 class="text-center">Contabilidad</h2>
    </template>

    <template v-if="menu==3">
        <h1 class="text-center">Tesoreria</h1>
    </template>

    <template v-if="menu==4">
        <contabilidad></contabilidad>
    </template>

    <template v-if="menu==5">
        <h1 class="text-center">Informes</h1>
    </template>

    <template v-if="menu==6">
        <entidad></entidad>
    </template>


    <div id="dock-container">
        <div id="dock">
            <ul>
                <li @click="menu=1">
                    <span>Presupuesto</span>
                    <a href="#"><img src="{{ asset('img/icon-1.png') }}"/></a>
                </li>
                <li @click="menu=2">
                    <span>Contabilidad</span>
                    <a href="#"><img src="{{ asset('img/icon-2.png') }}"/></a>
                </li>
                <li @click="menu=3">
                    <span>Tesoreria</span>
                    <a href="#"><img src="{{ asset('img/icon-3.png') }}"/></a>
                </li>
                <li @click="menu=4">
                    <span>Facturacion</span>
                    <a href="#"><img src="{{ asset('img/icon-4.png') }}"/></a>
                </li>
                <li @click="menu=5">
                    <span>Informes</span>
                    <a href="#"><img src="{{ asset('img/icon-5.png') }}"/></a>
                </li>
                <li @click="menu=6">
                    <span>Entidad</span>
                    <a href="#"><img src="{{ asset('img/icon-6.png') }}"/></a>
                </li>
            </ul>
        </div>
    </div>
@endsection