@extends('layouts.app')

@section('content')
        {{--databases--}}
        <div class="container">
            <div class="row">
              <div class="header">Choose Database</div>
              <form action="{{ route('getBasePost') }} " method="get">
                @foreach($bases as $base)
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="base[]" value='{{ $base->id }}' id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ $base->dbname }}</label>
                  </div>
                @endforeach
                  <button type="submit" class="btn btn-primary">Get Posts</button>
              </form>
            </div>
      </div>
@endsection
