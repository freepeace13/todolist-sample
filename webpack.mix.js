const path = require('path');
const mix = require('laravel-mix');

function resolve (dir) {
    return path.join(__dirname, '..', dir)
}

mix.js('resources/client/app.js', 'public/dist');

mix.webpackConfig({
    output: { chunkFilename: 'dist/[name].js?id=[chunkhash]' },
    resolve: {
        extensions: ['.vue', '.js'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
            '@models': path.join(__dirname, './resources/client/models'),
            '@components': path.join(__dirname, './resources/client/components'),
            '@utils': path.join(__dirname, './resources/client/utils'),
        }
    },

    module: {
        rules: [
            {
                test: /\.pug$/,
                oneOf: [
                    {
                        resourceQuery: /^\?vue/,
                        use: ['pug-plain-loader']
                    },
                    {
                        use: ['raw-loader', 'pug-plain-loader']
                    }
                ]
            }
        ]
    }
});
