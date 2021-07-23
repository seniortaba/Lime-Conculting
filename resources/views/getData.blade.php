@extends('layouts.app')

@section('content')

    <button class="btn btn-primary"><a style="color:white" href="http://127.0.0.1:8000/download_txt?download=Y&{{request()->getQueryString()}}"
                                       download="test.txt">get txt</a></button>
    <button class="btn btn-primary"><a style="color:white" href="http://127.0.0.1:8000/download_csv?download=Y&{{request()->getQueryString()}}&mode=csv"
                                       download="test.csv">get csv</a></button>

    {{--get posts from databases--}}
    <div class="row">
      <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Text</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $baseId => $records)
                <tr>
                    <th colspan="2" style="text-align: center">Base #{{$baseId}}</th>
                </tr>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record['post_title'] }}</td>
                        <td>
                            <div class="desc">
                                {{$record['post_content']  }}
                                <span class="toggleMore">View more..</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
