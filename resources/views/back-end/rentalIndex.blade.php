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
                        <a href="#rental" aria-controls="rentals" role="tab" data-toggle="tab">
                            @lang('rental.navRental')
                        </a>
                    </li>
                    <li role="presentation">
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
                            <div style="margin-bottom: 7px;" class="row">
                                <div class="col-md-6">
                                    <span class="pull-left">
                                        <form action="Verhuur/Search" method="POST" class="form-inline">
                                            <input type="text" name="Term" placeholder="Search" class="form-control">
                                            <button class="btn btn-danger" type="submit">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </form>
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <span class="pull-right">
                                        @if($notificationStatus === 1)
                                        <a role="button" class="btn btn-success" title="Notificaties is ingeschakeld" href="{{ Url::to('/notification/uit/' . Auth::user()->id) }}">
                                            Notificaties <span class="badge">Aan</span>
                                        </a>
                                        @elseif($notificationStatus === 0)
                                        <a role="button" class="btn btn-danger" title="Notificaties zijn uitgeschakeld" href="{{ Url::to('/notification/aan/' . Auth::user()->id) }}">
                                            Notificaties <span class="badge">Uit</span>
                                        </a>
                                        @endif

                                        <a href="Verhuur/Download_verhuringen" class="btn btn-info">
                                            <span class="octicon octicon-cloud-download"></span> Download
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <table class="table table-condensed">
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
                                            <td> {{ date('d-m-Y', (integer) $data->Start_Datum) }} - {{ date('d-m-Y', (integer) $data->Eind_datum) }} </td>

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
                                                        <a href="{{ URL::to('/backend/rental/confirm/' . $data->id) }}"
                                                           data-toggle="tooltip" title="Bevestig"
                                                           class="@if($data->Status == 2) disabled @endif btn btn-xs btn-success">

                                                            {{-- bevestigd --}}
                                                            <span class="octicon octicon-issue-closed"></span>
                                                        </a>
                                                        <a href="{{ URL::to('/backend/rental/option/' . $data->id) }}"
                                                           data-toggle="tooltip" title="Optie"
                                                           class="@if($data->Status == 1) disabled @endif btn btn-xs btn-success">

                                                            {{-- Option --}}
                                                            <span class="octicon octicon-issue-opened"></span>
                                                        </a>
                                                    </div>

                                                    <div class="btn-group">
                                                        <a href="{{ URL::to('/backend/rental/delete/' . $data->id) }}"
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

                    {{-- Add verhuring --}}
                    <div role="tabpanel" class="tab-pane" id="new">
                        <div style="padding-top: 10px;">
                            <form action="/rental/insert" method="POST">
                                {{-- CSRF token --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <label for="start">Start datum:</label>
                                <input name="StartDatum" placeholder="Start datum..." id="start" class="form-control" type="text">
                                <br>

                                <label for="eind">Eind datum:</label>
                                <input name="EindDatum" placeholder="Eind datum..." id="eind" class="form-control" type="text">
                                <br>

                                <label for="groep">Groep:</label>
                                <input name="Groep" placeholder="groep..." id="groep" class="form-control" type="text">
                                <br>

                                <label for="email">Email:</label>
                                <input name="Email" placeholder="email adres..." id="email" type="text" class="form-control">
                                <br>

                                <button type="submit" class="btn btn-success">
                                    Toevoegen
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- End add verhuring --}}
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
