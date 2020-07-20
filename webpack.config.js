const path = require('path');
const cleanPlugin = require('clean-webpack-plugin');

module.exports = {
  mode: 'development',
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
  devtool: 'cheap-module-eval-source-map',
  plugins: [
    new cleanPlugin.CleanWebpackPlugin(),
  ],
};
