@extends('layouts.app')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Form Test</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="/search/find">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="criteria">Criteria</label>
                                    <input type="text" class="form-control" name="criteria" id="criteria" placeholder="Ex.fitness">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="limit">Limit</label>
                                    <select class="form-control" id="limit" name="limit">
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="local">Local</label>
                                    <select class="form-control" id="locale" name="locale">
                                        <option value="en_US">en_US</option>
                                        <option value="es_ES">es_ES</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btsu">Submit</button>
                                    @php $user = auth()->user();@endphp
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

        @if(!empty($results))
            <div class="col-md-12">
                <br/>
                <span><strong> Results for: </strong> {{$request['criteria']}}</span> <br/>
                <div class="card">
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Path</th>
                                <th scope="col">Dis. Category</th>
                                <th scope="col">Links</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($results->data  as $key => $interest)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$interest->name}} </td>
                                        <td>{{ $interest->audience_size }}</td>
                                        <td class="font12">@if(!empty($interest->topic)) {{$interest->topic}} @endif</td>
                                        <td class="font12">{{json_encode($interest->path)}}</td>
                                        <td class="font12">@if(!empty($interest->disambiguation_category)) {{$interest->disambiguation_category}} @endif</td>
                                        <td class="link">
                                            <a target="_blank"  href="https://www.facebook.com/search/pages/?q={{$interest->name}}">
                                                <img width="15px" src="/images/facebook-icon.png"/>
                                            </a> &nbsp;&nbsp;
                                            <a target="_blank"  href="https://www.google.com/search?q={{$interest->name}}">
                                                <img width="15px" src="/images/google-icon.png"/>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
<style>
    .btsu {
        width: 90%;
        position:relative;
        top:25px;
    }

    .font12 {
        font-size: 12px;
    }
    .link {
        width:80px;
    }
</style>