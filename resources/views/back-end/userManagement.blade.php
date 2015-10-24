<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Include the header component --}}
        @include('partials.header')
    </head>
    <body>
        {{-- Include navbar component --}}
        @include('partials.navbar')

        <div class="row">
            <div class="wol-xs-12 col-sm-12 col-md-12 col-lg-12">
                {{-- Tab title's --}}
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                </ul>^
                {{-- End tab titles --}}

                {{-- Tab content --}}
                {{-- end tab content --}}
            </div>
        </div>

        {{-- @include the footer component --}}
        @include('partials.footer')
    </body>
</html>