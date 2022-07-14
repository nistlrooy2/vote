<x-app-layout>
    <script>
        function getRandomColor()
            {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
    </script>
    {{-- css only in this page --}}
    <style>
        .pie{ }
        .chart-span{
            margin:0 auto;
            text-align: center;
            display:block;
            
        }
    </style>

    {{-- include validate js only in this page --}}
    <script src="{{ asset('js/Chart.js') }}"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('zh_CN.vote result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($vote_sum != 0)
                    @foreach ($noweight as $key=>$vote)

                    @php
                        $vote_model = App\Models\Vote::where('id',$key)->first();
                        $title = $vote_model['title'];

                        //获取数据进入数组，在js中输出数值
                        $labels = array();
                        $data = array();
                        $backgroundColor =array();

                        
                        $weight_data = array();
                        
                        $description = "";
                        $description_weight = "";
                        foreach($vote as $k=>$v)
                        {

                            $option_model = App\Models\VoteOption::where('id',$k)->first();
                            $value = $option_model['value'];
                            
                            array_push($labels,$value);
                            array_push($data,$v);
                            array_push($backgroundColor,"getRandomColor()");
                            
                            array_push($weight_data,$weight->$key->$k);
                            $percent = 100*((float)$v/(float)$vote_sum[$key]);
                            $description = $description.$value.":".round($percent,2)."%  ";
                            $percent = 100*((float)($weight->$key->$k)/(float)$vote_weight_sum[$key]);
                            $description_weight = $description_weight.$value.":".round($percent,2)."%  ";
                        }
                        

                    @endphp

                        <div class="p-6 bg-white border-b border-gray-200 pie">  
                            <span>{{$title}}</span>                
                            <div style="width:80%">
                                <canvas id="myChart{{$key}}"></canvas>
                                <span class="chart-span">{{$description}}</span>
                                <span class="chart-span" style="padding-bottom: 50px;">投票结果</span>
                            </div>
                            <div style="width:80%">
                                <canvas id="myChartWeight{{$key}}"></canvas>
                                <span class="chart-span">{{$description_weight}}</span>
                                <span class="chart-span" style="padding-bottom: 50px;">加权投票结果</span>
                                
                            </div>

                        </div>

                        <script>

                            
                            var data{{$key}} = 
                            {
                                labels: [
                                    <?php
                                        foreach($labels as $label)
                                        {
                                            echo('"'.$label.'",');
                                        }
                                     ?>
                                ],
                                datasets: [
                                {
                                    data: [
                                        <?php
                                        foreach($data as $d)
                                        {
                                            echo($d.',');
                                        }
                                        ?>
                                    ],
                                    backgroundColor: [
                                        <?php
                                        foreach($backgroundColor as $bgcolor)
                                        {
                                            echo($bgcolor.',');
                                        }
                                        ?>
                                        ]
                                }]
                            };
                            var myPieChart{{$key}} = new Chart(myChart{{$key}}, {
                                type: "pie",
                                data: data{{$key}},
                                options: {}
                            });
                        </script>

                        <script>
                            var weightData{{$key}} = 
                            {
                                labels: [
                                    <?php
                                        foreach($labels as $label)
                                        {
                                            echo('"'.$label.'",');
                                        }
                                     ?>
                                ],
                                datasets: [
                                {
                                    data: [
                                        <?php
                                        foreach($weight_data as $d)
                                        {
                                            echo($d.',');
                                        }
                                        ?>
                                    ],
                                    backgroundColor: [
                                        <?php
                                        foreach($backgroundColor as $bgcolor)
                                        {
                                            echo($bgcolor.',');
                                        }
                                        ?>
                                        ]
                                }]
                            };
                            var myPieChartWeight{{$key}} = new Chart(myChartWeight{{$key}}, {
                                type: "pie",
                                data: weightData{{$key}},
                                options: {}
                            });
                        </script>
                        
                    @endforeach
                    
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ __('zh_CN.there is no vote record right now')}}
                    </div>
                @endif 
            </div>
            
        </div>
    </div>
    
    
    <script>
            
        
        $(document).ready(function()
        {
            
            
            
        });
        
        
    </script>

</x-app-layout>