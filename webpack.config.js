const path = require('path');
const webpack = require('webpack');
// const HtmlWebpackPlugin = require('html-webpack-plugin');
// const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const ExtractTextPlugin = require('extract-text-webpack-plugin');
// const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
// const CopyPlugin = require('copy-webpack-plugin');
// const VueLoaderPlugin = require('vue-loader/lib/plugin');
// const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
// const fs = require('fs');
// const os = require('os');
// const { env } = require('process');

module.exports = (env) => {

    const type = envVar(env, 'type');

    const mode = type === 'product' ? 'production' : 'development'

    const pathDir = type === 'product' ? path.resolve(__dirname, 'assets') : path.resolve(__dirname, '../../../public/calendar')

    console.log(pathDir)

    let output = {
        path: pathDir,
        filename: 'js/script.js'
    };

    return {
        mode: mode,
        entry: {
            script : './source/script.js'
        },
        output: output,
        plugins: [
            new webpack.ProvidePlugin({
                $: "jquery",
                jQuery: "jquery",
                "window.jQuery": "jquery"
            }),
            new MiniCssExtractPlugin({
                filename: 'css/style.css'
            })
        ],
        module: {
            rules: [
                {
                    test: /\.jsx?$/,
                    exclude: /(node_modules)/,
                    loader: "babel-loader",
                    options:{
                        presets:["@babel/preset-env", "@babel/preset-react"]
                    }
                },
                {
                    test: /\.js?$/,
                    exclude: /(node_modules)/,
                    loader: "babel-loader",
                    options:{
                        presets:["@babel/preset-env", "@babel/preset-react"]
                    }
                },
                {
                    test: /\.vue$/,
                    loader: 'vue-loader'
                },
                {
                    test: /\.css$/,
                    use: [
                      'vue-style-loader',
                      'css-loader'
                    ]
                },
                {
                    test: /\.s[ac]ss$/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                            options: {
                                hmr: mode
                            }
                        },
                        'css-loader',
                        {
                            loader: 'postcss-loader',
                            options: {
                                ident: 'postcss',
                                plugins: (loader) => [
                                    require('precss'),
                                    require('autoprefixer'),
                                    require('css-mqpacker'),
                                    require('cssnano')({
                                        preset: [
                                            'default', {
                                                normalizeWhitespace: 1
                                            }
                                        ]
                                    })
                                ]
                            }
                        },
                        'sass-loader'
                    ]
                },
                {
                    test: /\.(png|jpe?g|gif|svg)$/i,
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'img',
                        publicPath: '../img'
                    }
                },
                {
                    test: /\.(ttf|eot|woff|woff2)$/i,
                    loader: 'file-loader',
                    options: {
                        name: '[contenthash].[ext]',
                        outputPath: 'fonts',
                        publicPath: '../fonts'
                    }
                },
                {
                    test: /\.pug$/,
                    loader: 'pug-loader',
                    options: {
                        pretty: true,
                        compileDebug : true,
                        filters: false
                    }
                },
                {
                    test: /\.html$/i,
                    loader: 'html-loader',
                    options: {
                        // Disables attributes processing
                        attributes: true
                    }
                }
            ]
        },
        resolve: {
            alias: {
                vue: 'vue/dist/vue.js'
            },
        }
    };
};


const envVar = (env, key = '') => {
    const splitRes = (e) => {
        const param = e.split("=");
        return {
            key: param[0],
            val: param.length > 1 ? param[1] : true
        }
    }
    let result = [];
    if(env instanceof Array){
        let resIt = env.map(item => {
            return splitRes(item)
        })
        result = resIt;
    } else {
        let resIt = splitRes(env)
        result[0] = resIt;
    }
    if(key.length === 0) return result;

    return result.find(item => item.key === key).val
}
