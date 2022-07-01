<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("zh_CN.create votelist")}}
        </h2>
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">  
                    <form action="{{ route('voteListStore') }}" method="POST">  
                        @csrf
                        <div id="votelist">
                            <h3>{{__("zh_CN.create votelist")}}</h3>
                            <div>
                                <table>   
                                    <tr>
                                        <td><label for="votelist_title">{{__("zh_CN.title")}}</label></td>
                                        <td><input type="text" id ="votelist_title" name="votelist_title" value="{{ old('votelist_title') }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="votelist_description">{{__("zh_CN.description")}}</label></td>
                                        <td><textarea rows="5" cols="30" id="votelist_description" name="votelist_description">{{ old('votelist_description') }}</textarea></td>  
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="is_anonymous">{{__("zh_CN.is anonymous?")}}</label>
                                        </td>
                                        <td>
                                            <input type="radio" name="is_anonymous" id="is_anonymous-1" value="1">{{__("zh_CN.anonymous")}}<br/>
                                            <input type="radio" name="is_anonymous" id="is_anonymous-0" checked="checked" value="0">{{__("zh_CN.no anonymous")}}
                                        </td>
                                    </tr>
                                    <tr id="tr_partment">
                                        <td>
                                            <label for="partment">{{__("zh_CN.partment")}}</label>
                                        </td>
                                        <td>
                                            <select name="partment">
                                                @foreach($partment as $p)
                                                    <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="starttime">{{__("zh_CN.start time")}}</label>
                                        </td>
                                        <td>
                                            <input type="text" id="starttime"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="endtime">{{__("zh_CN.end time")}}</label>
                                        </td>
                                        <td>
                                            <input type="text" id="endtime"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button id="next_button" class="ui-button ui-widget ui-corner-all">{{__('zh_CN.next')}}</button> 
                                        </td>
                                        
                                    </tr>
                                
                                </table>
                            </div>
                            <h3>{{__("zh_CN.create vote")}}</h3>
                            <div>

                                <div id="dialog" title="{{__("zh_CN.write data")}}">
                                    <fieldset class="ui-helper-reset">
                                    <label for="tab_title">{{__("zh_CN.title")}}</label>
                                    <input type="text" name="tab_title" id="tab_title" value="Title" class="ui-widget-content ui-corner-all">
                                    <label for="tab_content">{{__("zh_CN.description")}}</label>
                                    <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">content</textarea>
                                    </fieldset>
                                </div>
                                <button id="prev_button" class="ui-button ui-widget ui-corner-all">{{__('zh_CN.previous')}}</button> 
                                <button id="add_tab">{{__("zh_CN.add vote")}}</button>
                                <div id="tabs">
                                    <ul>
                                      <li><a href="#tabs-1">1</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
                                    </ul>
                                    <div id="tabs-1">
                                      <table>
                                        <tr>
                                            <td><label for="vote_title-1">{{__("zh_CN.title")}}</label></td>
                                            <td><input type="text" id ="vote_title-1" name="vote_title-1" value="{{ old('vote_title-1') }}"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="votelist_description-1">{{__("zh_CN.description")}}</label></td>
                                            <td><textarea rows="5" cols="30" id="votelist_description-1" name="votelist_description-1">{{ old('votelist_description-1') }}</textarea></td>  
                                        </tr>
                                        <tr>
                                            <td>{{__("zh_CN.vote option")}}</td>
                                            <td class='option'>
                                                <input type="text" id ="vote_option-1-1" name="vote_option-1-1" value="{{ old('vote_option-1-1') }}">
                                                <input type="text" id ="vote_option-1-2" name="vote_option-1-2" value="{{ old('vote_option-1-2') }}">
                                                <button id="add_option-1" class="ui-button ui-widget ui-corner-all option-add-button" title='add'>{{__("zh_CN.add option")}}</button>
                                                
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                      </table>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div> 
                        <button type="submit">{{}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- css only in this page --}}
    <style>
        #dialog label, #dialog input { display:block; }
        #dialog label { margin-top: 0.5em; }
        #dialog input, #dialog textarea { width: 95%; }
        #tabs { margin-top: 1em; }
        #tabs li .ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
        #add_tab { cursor: pointer; }
    </style>
    <script>
            
        
        $(document).ready(function()
        {
            //vote create js
            $( function() 
            {
                //datetime picker
                jQuery.datetimepicker.setLocale('ch');
                $( "#starttime" ).datetimepicker();
                $( "#endtime" ).datetimepicker();
                
                //when anonymous selected partment hide
                $("#is_anonymous-1").click(function () {
                    if ($(this).prop("checked")) {
                        $('#tr_partment').hide();
                    } 
                });
                
                // if not anonymous selected partment show 
                $("#is_anonymous-0").click(function () {
                    if ($(this).prop("checked")) {
                        $('#tr_partment').show();
                    } 
                });

                $("#votelist").accordion({
                    //autoheight: false
                });

                $( ".widget , .widget button" ).button();
            
                //toggle the accordion
                $("#next_button").click(function (event) {
                    $("#votelist").accordion({active: 1});
                    event.preventDefault();
                    
                });
                $("#prev_button").click(function (event) {
                    $("#votelist").accordion({active: 0});
                    event.preventDefault();
                });


                var tabTitle = $( "#tab_title" ),
                tabContent = $( "#tab_content" ),
                tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
                // tab number
                tabCounter = 2;
            
                var tabs = $( "#tabs" ).tabs({
                    activate: function( event, ui ) {},
                });
            
                // Modal dialog init: custom buttons and a "close" callback resetting the form inside
                var dialog = $( "#dialog" ).dialog({
                    autoOpen: false,
                    modal: true,
                    buttons: {
                        添加: function() {
                        addTab();
                        $( this ).dialog( "close" );
                        },
                        取消: function() {
                        $( this ).dialog( "close" );
                        }
                    },
                    close: function() {
                        $('#tab_title').val('');
                        $('#tab_content').val('');
                    }
                });
                 // AddTab form: calls addTab function on submit and closes the dialog
                var form = dialog.find( "#dialog" ).on( "submit", function( event ) {
                    addTab();
                    dialog.dialog( "close" );
                    event.preventDefault();
                });
            
                // Actual addTab function: adds new tab using the input from the form above
                function addTab() {
                    var label = tabTitle.val() || "Tab " + tabCounter,
                        id = "tabs-" + tabCounter,
                        li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, tabCounter ) ),
                        //li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
                        tabTitleHtml = tabTitle.val(),
                        tabContentHtml = tabContent.val();
                        //tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";
                
                    tabs.find( ".ui-tabs-nav" ).append( li );
                    tabs.append( "<div id='" + id + "'><table>"+
                        "<tr>"+
                            "<td><label for='tab_title-"+tabCounter+"'>{{__("zh_CN.title")}}</label></td>"+
                            "<td><input type='text' id ='vote_title-"+tabCounter+"' name='vote_title-"+tabCounter+"' value='"+tabTitleHtml+"'></td></tr><tr>"+
                            "<td><label for='votelist_description-"+tabCounter+"'>{{__("zh_CN.description")}}</label></td>"+
                            "<td><textarea rows='5' cols='30' id='votelist_description-"+tabCounter+"' name='votelist_description-"+tabCounter+"'>"+tabContentHtml +"</textarea></td>"+
                        "</tr>"+
                        "<tr>"+
                            "<td>{{__("zh_CN.vote option")}}</td>"+
                            "<td class='option'>"+
                                "<input type='text' id ='vote_option-"+tabCounter+"-1' name='vote_option-"+tabCounter+"-1' value=''>"+
                                "<input type='text' id ='vote_option-"+tabCounter+"-2' name='vote_option-"+tabCounter+"-2' value=''>"+
                                "<button id='add_option-"+tabCounter+"' class='ui-button ui-widget ui-corner-all option-add-button' title='add'>{{__("zh_CN.add option")}}</button>"+
                            "</td>"+
                        "</tr>"+
                        "</table></div>");
                    tabs.tabs( "refresh" );
                    tabCounter++;
                };

                // AddTab button: just opens the dialog
                $( "#add_tab" )
                .button()
                .on( "click", function(event) {
                    event.preventDefault();
                    dialog.dialog( "open" );
                });

                // Close icon: removing the tab on click
                tabs.on( "click", "span.ui-icon-close", function() {
                    var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
                    $( "#" + panelId ).remove();
                    tabs.tabs( "refresh" );
                    tabCounter--;
                });
                // alt+ backspace = close icon
                tabs.on( "keyup", function( event ) {
                if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
                    var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
                    $( "#" + panelId ).remove();
                    tabs.tabs( "refresh" );
                    tabCounter--;
                    }   
                });
                
                //$(".option").delegate(".option-add-button","click",function(event)
                //bind tab-1 add button
                $(".option").delegate("#add_option-1","click",function(event)
                {
                    event.preventDefault();
                    $option_index = ($(this).parent().children("input").length)+1;

                    $( this ).before("<input type='text' id ='vote_option-1-"+$option_index+"' name='vote_option-1-"+$option_index+"' value='{{ old('vote_option-1-"+$option_index+"') }}'>");
                    $option_index++;
                    
                    if($option_index>2 && !$( this ).next().is('button'))
                    {
                        $( this ).after("<button id='del_option-1' class='ui-button ui-widget ui-corner-all option-del-button'>{{__("zh_CN.del option")}}</button>")
                    }
                        
                });

                //bind tab-1 del button
                $(".option").delegate("#del_option-1","click",function(event)
                {
                    event.preventDefault();
                    $option_number = ($(this).parent().children("input").length);   
                    $( '#vote_option-1-'+$option_number).remove();
                    $option_number--;
                    if($option_number<3)
                    {
                        $("#del_option-1").remove();
                    }  
                });
                
                $( "#tabs" ).on( "tabsactivate", function( event, ui ) {
                    //unbind before bind click, just bind once
                    $(".option").unbind('click');
                    $(".option").delegate(".option-add-button","click",function(event)
                    {
                        event.preventDefault();
                        //get the tab id
                        $input_id = $( this ).parent().children('input').attr("id");
                        $tab_index_start = $input_id.indexOf('-')+1;
                        $tab_index_end = $input_id.lastIndexOf('-');
                        $tab_index = $input_id.slice($tab_index_start,$tab_index_end);
                        $option_index = ($(this).parent().children("input").length)+1;

                        $( this ).before("<input type='text' id ='vote_option-"+$tab_index+"-"+$option_index+"' name='vote_option-"+$tab_index+"-"+$option_index+"' value='{{ old('vote_option-"+$tab_index+"-"+$option_index+"') }}'>");
                        $option_index++;
                        if($option_index>2 && !$( this ).next().is('button'))
                        {
                            $( this ).after("<button id='del_option-"+$tab_index+"' class='ui-button ui-widget ui-corner-all option-del-button'>{{__("zh_CN.del option")}}</button>")
                        }
                            
                    });

                    $(".option").delegate(".option-del-button","click",function(event)
                    {
                        event.preventDefault();
                        $input_id = $( this ).parent().children('input').attr("id");
                        $tab_index_start = input_id.indexOf('-')+1;
                        $tab_index_end = $input_id.lastIndexOf('-');
                        $tab_index = $input_id.slice($tab_index_start,$tab_index_end);
                        $option_number = ($(this).parent().children("input").length);
                        $( '#vote_option-'+$tab_index+'-'+$option_number).remove();
                        $option_number--;
                        if($option_number<3)
                        {
                            $("#del_option-"+$tab_index).remove();
                        } 
                            
                    });
                } );

                

            });
        });
    </script>


</x-app-layout>