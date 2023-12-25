<x-app-layout title="Dashboard">
    <div class="alert alert-lg alert-info">Anda Login sebagai <span class="text-uppercase fw-bold">{{ Auth::user()->role }}</span></div>
    <h1>Dashboard</h1>
</x-app-layout>
