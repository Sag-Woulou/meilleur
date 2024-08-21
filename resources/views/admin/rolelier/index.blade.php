@extends('adminbase.dashboard')
@section('tableview')
    <h2>Liste des Rôles</h2>
    <table>
        <thead>
        <tr>
            <th>Rôle</th>
            <th>Permissions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <ul>
                        @foreach($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
