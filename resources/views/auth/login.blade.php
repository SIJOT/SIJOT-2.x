<!DOCTYPE html>
<html>
<head>
    <title> Leidings gedeelte </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/login.css" />
<head>
<body>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-wrap">
                        <h1>Leidings gedeelte!</h1>

                        <?php if (! empty($errors) && count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach($errors->all() as $error): ?>
                                        <li>{{ $error }}</li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    <form method="POST" action="{{URL::to('/login')}}">
                        {{-- CSRF Token --}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="text" class="sr-only">Gebruikersnaam</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Wachtwoord</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>

                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                        </form>
                            <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Wachtwoord vergeten?</a>
                            <hr>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Sluit</span>
                    </button>
                    <h4 class="modal-title">Aanvraag nieuw wachtwoord.</h4>
                </div>
                <div class="modal-body">
                    <p>Type your email account</p>
                    <form method="POST" action="/index.php/Verifylogin/reset">
                    <input placeholder="Email adres" type="email" name="recovery" id="recovery-email" class="form-control" autocomplete="off">
                </div>
                    <div class="modal-footer">
                            <button role="button" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button role="button" type="submit" class="btn btn-custom">Recupereer</button>
                        </form>
                    </div>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>St-joris © - {{ date('Y') }}</p>
                        <p>Powered by <strong>Bootstrap</strong></p>
                    </div>
                </div>
            </div>
        </footer>

        {{-- Include JavaScript at the bottom so the page loads faster --}}
        <script src="/js/login.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </body>
</html>
