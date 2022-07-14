<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('zh_CN.vote result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($vote_list as $list)
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        @php
                            $result = App\Models\VoteResult::where('vote_list_id',$list['id'])->first();
                        @endphp
                        @if (!$result) 
                            @if(Auth::user()->hasPermission('add_vote_lists'))
                                <a href="{{ url('/voteListResult/create/'.$list['id']) }}">{{ $list['title'] }}({{__('zh_CN.click to create the result')}})</a>
                            @else
                                <span class="no-result">{{ $list['title'] }}({{__('zh_CN.waiting for Vote Admin to create the result')}})</span>
                            @endif
                        @else 
                            <a href="{{ url('/voteListResult/index/'.$list['id']) }}">{{ $list['title'] }}({{__('zh_CN.click and get the result')}})</a>
                        @endif
                    </div>
                @endforeach   
            </div>
            @if(!count($vote_list))
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('zh_CN.there is no vote right now')}}
                </div>
            @endif
            {{ $vote_list->links() }}
        </div>
    </div>
    {{-- css only in this page --}}
    <style>
        .no-result{ color: grey;}
    </style>

    {{-- include validate js only in this page --}}

    
    <script>
            
        
        $(document).ready(function()
        {
            
        });
    </script>

</x-app-layout>