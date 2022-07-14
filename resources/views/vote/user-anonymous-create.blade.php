<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('zh_CN.anonymous') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('anonymousStore') }}" method="POST" id="anonymous_create">
                        @csrf
                        <table>
                            <tr>
                                <td>
                                    <label for="level">{{__("zh_CN.user position level")}}</label>
                                </td>
                                <td>
                                    <select name="level" required>
                                        @foreach($user_level as $level)
                                            <option value="{{ $level['id'] }}" @selected(old('level') == $level['id'])>{{ $level['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="number">{{__("zh_CN.the number will create")}}</label>
                                </td>
                                <td>
                                    <input name="number" id="user_number" type="text" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit"class="ui-button ui-widget ui-corner-all ">{{__("zh_CN.create and export anonymous")}}</button>
                                </td>
                            </tr>

                        </table>

                        
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    {{-- css only in this page --}}
    <style>

    </style>

    {{-- include validate js only in this page --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/messages_zh.min.js') }}"></script>

    
    <script>
            
        
        $(document).ready(function()
        {
            $("#anonymous_create").validate();
        });
    </script>

</x-app-layout>