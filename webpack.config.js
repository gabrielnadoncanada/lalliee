var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

var encoreConfig = Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/fonts', to: 'fonts' },
        { from: './assets/images', to: 'images'},
        { from: './assets/js', to: 'js', flatten: true },
        { from: './vendor/nadmin/wcm-bundle/Resources/public/assets', to: '../bundles/wcm/assets' },
    ]))
    .enableSingleRuntimeChunk()
    .addStyleEntry('/wcm/app', './vendor/nadmin/wcm-bundle/Resources/public/assets/scss/wcm.scss')
    .addStyleEntry('/css/style', './assets/scss/custom/style.scss')
    .addStyleEntry('/css/fonts', './assets/scss/fonts/fonts.scss')
    .addStyleEntry('/css/bootstrap', './assets/scss/bootstrap/bootstrap.scss')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader(function(options) {}, { resolveUrlLoader: false })
    // .enablePostCssLoader()
;

module.exports = encoreConfig.getWebpackConfig();
