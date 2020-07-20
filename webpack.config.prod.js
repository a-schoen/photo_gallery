const path = require('path');
const cleanPlugin = require('clean-webpack-plugin');

module.exports = {
  mode: 'production',
  entry: {
    index: './src/index.js',
    image: './src/image.js',
    gallery: './src/gallery.js',
    galleries: './src/galleries.js',
    contact: './src/contact.js',
    admin: './src/admin-page.js',
  },
  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'assets', 'js'),
  },
  devtool: 'cheap-source-map',
  plugins: [
    new cleanPlugin.CleanWebpackPlugin(),
  ],
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', {useBuiltIns: 'usage', corejs: {version: 3}}],
            ],
          },
        },
      },
    ],
  },
};
