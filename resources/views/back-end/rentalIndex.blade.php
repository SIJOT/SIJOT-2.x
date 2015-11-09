<!DOCTYPE html>
<html>
    <head>
        {{-- header component --}}
        @include('partials.header')
    </head>
    <body>
        {{-- navbar component --}}
        @include('partials.navbar')

        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                {{-- tab navigation pills --}}
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#rentals" aria-controls="rentals" role="tab" data-toggle="tab">
                            @lang('rental.navRental')
                        </a>
                    </li>
                    <li>
                        <a href="#new" aria-controls="new" role="tab" data-toggle="tab">
                            @lang('rental.navNewRental')
                        </a>
                    </li>
                </ul>
                {{-- end tab navigation pills --}}

                {{-- tab navigation --}}
                <div class="tab-content">
                    {{-- rental index --}}
                    <div role="tabpanel" class="tab-pane active" id="rental">
                        <div style="padding-top: 10px;">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">#</th>
                                        <th class="col-sm-2">Periode:</th>
                                        <th class="col-sm-1">Status:</th>
                                        <th class="col-sm-3">Groep/Persoon:</th>
                                        <th class="col-sm-3">Email:</th>
                                        <th class="col-sm-2"></th> {{-- Handlings --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dbData as $data)
                                        <tr>
                                            <td><code>#{{ $data->id }}</code></td>
                                            <td> {{ $data->Start_datum }} - {{ $data->Eind_datum }} </td>

                                            <td>
                                                @if($data->Status == 0)
                                                    <span class="label label-danger">
                                                        Onbevestigd
                                                    </span>
                                                @elseif($data->Status == 1)
                                                    <span class="label label-warning">
                                                        Optie
                                                    </span>
                                                @elseif($data->Status == 2)
                                                    <span class="label label-success">
                                                        Bevestigd
                                                    </span>
                                                @endif
                                            </td>

                                            <td> {{ $data->Groep }} </td>
                                            <td>
                                                <a href="mailto:{{ $data->Email }}">
                                                    {{ $data->Email }}
                                                </a>
                                            </td>

                                            {{-- rental options --}}
                                            <td>
                                                <div class="btn-toolbar">
                                                    <div class="btn-group">
                                                        <a href="{{ URL::to('' . $data->id) }}"
                                                           data-toggle="tooltip" title="Bevestig"
                                                           class="@if($data->Status == 2) disabled @endif btn btn-xs btn-success">

                                                            {{-- bevestigd --}}
                                                            <span class="octicon octicon-issue-closed"></span>
                                                        </a>
                                                        <a href="{{ URL::to('' . $data->id) }}"
                                                           data-toggle="tooltip" title="Optie"
                                                           class="@if($data->Status == 1) disabled @endif btn btn-xs btn-success">

                                                            {{-- Option --}}
                                                            <span class="octicon octicon-issue-opened"></span>
                                                        </a>
                                                    </div>

                                                    <div class="btn-group">
                                                        <a href="{{ URL::to('' . $data->id) }}"
                                                           data-toggle="tooltip" title="Verwijder"
                                                           class="btn btn-xs btn-danger">

                                                            <span class="octicon octicon-trashcan"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- end rental options --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- end rental index --}}
                </div>
                {{-- end tab navigation --}}

            </div>
        </div>

        {{-- footer component --}}
        @include('partials.footer')

        {{-- javascript for tooltip --}}
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip({
                    placement: "right"
                });
            });
        </script>
    </body>
</html>