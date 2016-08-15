@extends('app')
@section('content')
<div class="container">
    <h3>Pedidos</h3>

    <br>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
              
                <th>Ação</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($orders as $ord)
            <tr>
                <td>{{$ord->id}}</td>
                <td>
                    <a class="btn btn-default btn-sm" href="">
                    Editar
                    </a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    
    </table>
{!! $orders->render() !!}
</div>

@endsection