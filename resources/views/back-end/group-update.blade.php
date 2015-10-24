<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Load the header file --}}
        @include('partials.header')

        {{-- TinyMCE editor --}}
        <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>

        <!-- TODO: set this to external css file. -->
        <style>
            .top-padding-10 {
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        {{-- Load the navigation bar --}}
        @include('partials.navbar')


        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div>
                        {{-- Tab navigation --}}

                        <!-- Navbar pills Selectors.       -->
                        <!-- ============================= -->
                        <!-- De Kapoenen     = #kapoenen   -->
                        <!-- De Welpen       = #welpen     -->
                        <!-- De Jong-Givers  = #jongGivers -->
                        <!-- De Givers       = #givers     -->
                        <!-- De Jins         = #jins       -->
                        <!-- De Leiding      = #leiding    -->

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#kapoenen" aria-controls="kapoenen" role="tab" data-toggle="tab">
                                    De Kapoenen
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#welpen" aria-controls="welpen" role="tab" data-toggle="tab">
                                    De Welpen
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#jongGivers" aria-controls="jongGivers" role="tab" data-toggle="tab">
                                    De Jong-givers
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#givers" aria-controls="givers" role="tab" data-toggle="tab">
                                    De Givers
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#jins" aria-controls="jins" role="tab" data-toggle="tab">
                                    De Jins
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#leiding" aria-controls="leiding" role="tab" data-toggle="tab">
                                    De Leiding
                                </a>
                            </li>
                        </ul>
                        {{-- End tab navigation --}}

                        {{-- Tab content --}}
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="kapoenen">
                                <div class="row top-padding-10">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($kapoenen as $value1)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="welpen">
                                <div class="row top-padding-10">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($welpen as $value2)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="jongGivers">
                                <div class="row top-padding-10">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($jongGivers as $value3)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="givers">
                                <div class="row top-padding-10">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($givers as $value4)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="jins">
                                <div class="row top-padding-10">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($jins as $value5)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="leiding">
                                <div class="row top-padding-10">
                                    <div class="row-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        @foreach($leiding as $value6)
                                            <form method="" action="">
                                                <label for="title"> Tak: </label>
                                                <input class="form-control" id="title" placeholder="Tak" value="{{ $value6->Title }}" />
                                                <br />

                                                <label for="subtitle"> Sub titel </label>
                                                <input class="form-control" id="subtitle" placeholder="Sub titel" />
                                                <br>

                                                <label for="beschrijving"> Beschrijving </label>
                                                <textarea></textarea>
                                                <br>

                                                <button class="btn btn-success" type="submit">
                                                    Aanpassen
                                                </button>
                                                <button class="btn btn-danger">
                                                    Reset
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End tab content --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Load the footer partial --}}
        @include('partials.footer')

        {{-- Pusher includes --}}
        <script src="{{URL::to('/') }}/js/jquery.bootstrap-growl.min.js"></script>
        <script src="https://js.pusher.com/2.2/pusher.min.js"></script>

        {{-- Add the pusher partial --}}
        @include('partials.pusher')
    </body>
</html>