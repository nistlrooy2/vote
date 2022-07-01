<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('zh_CN.Dash board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @php
                    $number = 0; 
                @endphp

                @foreach ($voteList as $vote)
                    
                    @if ($partment_id_collect->contains($vote['partment_id']) || $vote['is_anonymous'] == 1)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="{{ url('/voteList/'.$vote['id']) }}">{{ $vote['title'] }}</a>
                        </div>
                        @php
                            $number++;
                        @endphp
                    @endif

                @endforeach

                @if($number > 0)
                    <div class="p-6 bg-white border-b border-gray-200">
                        votelistNumber:{{ $number }}
                    </div>
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ __('there is no vote right now')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
