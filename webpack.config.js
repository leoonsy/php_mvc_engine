//конфигурация webpack
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const path = require('path')

module.exports = (env, options) => {
    let isProduction = options.mode == 'production';
    let isDevelopment = !isProduction;

    let conf = {
        entry: './srcwp/scripts/mainwp.js',
        output: {
            filename: 'scripts/mainwp.min.js',
            path: path.resolve(__dirname, 'dist'),
            publicPath: '/'
        },
        mode: options.mode || 'development',
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env']
                        }
                    }
                },
                {
                    test: /\.css$/,
                    use: [
                        'vue-style-loader',
                        'css-loader'
                    ]
                },
                {
                    test: /\.scss$/,
                    use: [
                        'vue-style-loader',
                        'css-loader',
                        'sass-loader'
                    ]
                },
                {
                    test: /\.vue$/,
                    loader: 'vue-loader'
                },
                {
                    test: /\.(png|jpg|gif|svg)$/,
                    loader: 'file-loader',
                    options: {
                        name: `images/[name].[ext]`,
                        esModule: false,
                    }
                }
            ]
        },
        plugins: [
            new VueLoaderPlugin()
        ],
        resolve: {
            extensions: ['.js', '.vue', '.json'],
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
            }
        },
        devtool: isDevelopment ? 'eval-sourcemap' : false
    }

    return conf;
};