<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('zh_CN.vote page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('voteStore') }}" method="POST" id="vote_form">
                        @csrf
                        <div class="votelist_div">
                            <p>
                                {{ $voteList['title'] }}
                            </p>
                            <p>{{ $voteList['description'] }}</p>
                        </div>
                        @foreach ($vote as $voteInfo)
                        <div class="vote_div">
                            <p>{{$loop->iteration}}.{{ $voteInfo['title'] }}</p>
                            <p>(可选数量：{{ $voteInfo['selectable_number'] }})</p>
                            
                                @foreach ($option[$loop->index] as $op)
                                    @if ( $voteInfo['selectable_number'] > 1 )
                                        @if ($loop->first)
                                            <div><input type="checkbox" id="op-{{$loop->parent->index}}-{{$loop->index}}" name="option[{{$loop->parent->index}}][]" value="{{$op['id']}}" required minlength="{{$voteInfo['selectable_number']}}">{{$op['value']}}</div>
                                            
                                        @else
                                            <div><input type="checkbox" id="op-{{$loop->parent->index}}-{{$loop->index}}" name="option[{{$loop->parent->index}}][]" value="{{$op['id']}}" >{{$op['value']}}</div>
                                            
                                        @endif  
                                    @else
                                        @if ($loop->first)
                                            <div><input type="radio" id="op-{{$loop->parent->index}}-{{$loop->index}}" name="option[{{$loop->parent->index}}][]" value="{{$op['id']}}" required>{{$op['value']}}</div>
                                            
                                        @else
                                            <div><input type="radio" id="op-{{$loop->parent->index}}-{{$loop->index}}" name="option[{{$loop->parent->index}}][]" value="{{$op['id']}}" >{{$op['value']}}</div>
                                        
                                        @endif  
                                    @endif
                                @endforeach
                            @if ( $voteInfo['selectable_number'] > 1 )
                                <label for="option[{{$loop->index}}][]" class="error">Please select at least three types of spam.</label>
                            @else
                                <label for="option[{{$loop->index}}][]" class="error">requerd</label>
                            @endif
                        </div>
                        @endforeach
                        <button type="submit"class="ui-button ui-widget ui-corner-all submit">{{__("zh_CN.submit")}}</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- css only in this page --}}
    <style>
        .votelist_div input {display: block;}
        .vote_div {margin-top: 20px;margin-left: 20px;margin-bottom: 20px;}
        .vote_div p {style="margin-top: 10px;margin-bottom: 10px;"}
        label.error {display: none;color:red;}
    </style>

    {{-- include validate js only in this page --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/messages_zh.min.js') }}"></script>
    
    <script>
            
        
        $(document).ready(function()
        {
            $("#vote_form").validate();
        });
    </script>

</x-app-layout>