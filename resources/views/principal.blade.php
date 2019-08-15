@extends('layouts.app')

@section('content')
    <template v-if="menu==0">
        <menu-principal></menu-principal>
    </template>

    <template v-if="menu==1">
        <h1 class="text-center">Presupuesto</h1>
    </template>

    <template v-if="menu==2">
      <contabilidad></contabilidad>
    </template>

    <template v-if="menu==3">
        <h1 class="text-center">Tesoreria</h1>
    </template>

    <template v-if="menu==4">
        <facturacion></facturacion>
    </template>

    <template v-if="menu==5">
        <h1 class="text-center">Informes</h1>
    </template>

    <template v-if="menu==6">
      <personas></personas>
    </template>

    <template v-if="menu==7">
      <h1 class="text-center">talento humano</h1>
    </template>

    <template v-if="menu==8">
      <h1 class="text-center">Archivo</h1>
    </template>

    <template v-if="menu==20">
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
                    <span>Personas</span>
                    <a href="#"><img src="{{ asset('img/icon-6.png') }}"/></a>
                </li>
                <li @click="menu=7">
                    <span>Talento humano</span>
                    <a href="#"><img src="{{ asset('img/icon-7.png') }}"/></a>
                </li>
                <li @click="menu=8">
                    <span>Archivo</span>
                    <a href="#"><img src="{{ asset('img/icon-8.png') }}"/></a>
                </li>
                <li @click="menu=20">
                    <span>Entidad</span>
                    <a href="#"><img src="{{ asset('img/icon-x.png') }}"/></a>
                </li>
            </ul>
        </div>
    </div>
@endsection
