// Include required libraries
var elixir = require('laravel-elixir');

// Compile the .scss files.
// Multiple file's = mix.sass(['file1.scss', 'file2.scss']);
// Use the version file client-side = {{ elixir('css/all.css') }}
elixir(function(mix) {
    mix.sass('app.scss')
        .version('js/app.js');
});

// BrowserSynch 
// You can trigger it with the `gulp watch` command.
elixir(function(mix) {
    mix.browserSync();
});

// Running phpunit 
// You can trigger it with the `gulp tdd command`






