@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Usuários" />
        <div><x-btnadd icon="user-plus" text="Novo Usuário" btnHref="{{ route('users.create') }}" /></div>
    </div>


    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="users display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th style="width: 60px">Ação</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <x-btnedit btnHref="{{ route('users.edit', $user->id) }}" />
                                            @if (Auth::user()->id !== $user->id)
                                                <x-btndelete actionBtn="{{ route('users.destroy', $user->id) }}"
                                                    aletbtn="Tem certeza que deseja excluir este usuário?" />
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
