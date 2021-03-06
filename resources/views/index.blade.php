@extends("lapse::app")

@section('content')
<div class="lapse-body">
    <br/>
    <div>
        <h3 style="text-align: center; margin-bottom: 20px"> LARAVEL LAPSE</h3>
        <h4 style="text-align: center; margin-bottom: 50px">Laravel Self Hosted Error Tracking System</h4>
    </div>
    <div>
        <form class="form-inline" action="{{ route('lapse.index') }}">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" placeholder="Search" name="q" value="{{$q}}"/>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <div class="input-group input-daterange datepicker">
                    <input type="text" class="form-control" name="from" value="{{$from}}" autocomplete="off">
                    <div class="input-group-addon" style="margin-right:10px; margin-left:10px;">to</div>
                    <input type="text" class="form-control" name="to" value="{{$to}}" autocomplete="off">
                </div>
            </div>
            <button class="btn btn-primary mb-2">Search</button>
        </form>
    </div>
    <br/>
    <br/>
    @if($lapses->count())
        <div class="wrap-table100">
            <div class="table">
                <div class="row header">
                    <div class="cell">
                        URL
                    </div>
                    <div class="cell">
                        CLASS
                    </div>
                    <div class="cell">
                        TITLE
                    </div>
                    <div class="cell">
                        USER
                    </div>
                    <div class="cell">
                        DATE
                    </div>
                </div>

                @foreach($lapses as $lapse)
                    <a class="row data" href="{{ route('lapse.detail',$lapse->id) }}">
                        <div class="cell" data-title="URL">
                            {{ $lapse->url }}
                        </div>
                        <div class="cell" data-title="LAPSE CLASS">
                            {{ $lapse->class }}
                        </div>
                        <div class="cell" data-title="LAPSE TITLE">
                            {{ $lapse->title }}
                        </div>
                        <div class="cell" data-title="User">
                            {{ $lapse->user_id or 'unknown' }}
                        </div>
                        <div class="cell" data-title="User">
                            {{ $lapse->created_at->format("D M Y h:i:s") }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div>
            <br/>
            {{ $lapses->appends(['q' => $q, 'from' => $from, 'to' => $to])->links() }}
        </div>
    @endIf

    @if($lapses->count())
    <div class="container">
        <form method="post" action="{{ route('lapse.clear') }}" style="display:flex; justify-content: center; margin-top: 50px">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <br/>
            <button type="submit" class="btn btn-dark btn-lg">
                Delete All Lapse Records
            </button>
        </form>
    </div>
    @endIf
</div>
@endsection

@push('js')
    <script>
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy'
        });
    </script>
@endpush