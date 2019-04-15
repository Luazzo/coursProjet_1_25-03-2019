// webpack.config.js
var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');


//--------------------------------------------------------------------------------------------------
//Pour resoudre un Error lié avec PHPStorm :
//       Encore.setOutputPath() cannot be called yet because the runtime environment
//       doesn't appear to be configured. Make sure you're using the encore executable
//       or call Encore.configureRuntimeEnvironment() first if you're purposely
//       not calling Encore directly.
// https://github.com/symfony/symfony-docs/commit/184575db8a88e1c33a1df62ef15473037068cdbc
// Resultat : Event Log : Module resolution rules from webpack.config.js are now used for coding assistance.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}
//--------------------------------------------------------------------------------------------------



Encore
    .addPlugin(new CopyWebpackPlugin([
        // copies to {output}/static
        { from: './assets/img', to: 'img' }
    ]))

    // the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')
    .addEntry('bootstrap.min', './assets/js/bootstrap.min.js')
    .addEntry('jquery.easing.min', './assets/js/jquery.easing.min.js')
    .addEntry('jquery-1.9.1.min', './assets/js/jquery-1.9.1.min.js')
    .addEntry('scrolling-nav', './assets/js/scrolling-nav.js')

    //  je le mets directement a cause d'un erreur pendant compilation
    // .addEntry('modernizr-2.6.2-respond-1.1.0.min', './assets/js/modernizr-2.6.2-respond-1.1.0.min.js')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    .enableSingleRuntimeChunk()

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()

// allow sass/scss files to be processed
// .enableSassLoader()
;
/*
module.exports = {
    module: {
        rules: [
            {
                test: /.[\\\/]assets[\\\/]js[\\\/]modernizr-2.6.2-respond-1.1.0.min\.js$/,
                loader: "imports-loader?this=>window!exports-loader?window.Modernizr"
            }
        ]
    }
};
*/
//require('imports-loader?this=>window!modernizr');
// export the final configuration
var config = Encore.getWebpackConfig();
config.externals.jquery = 'jquery-3.4.0.min';
module.exports = config;