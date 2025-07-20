const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
  ...defaultConfig,
  entry: {
    'blocks': path.resolve(__dirname, 'assets/js/blocks.js'),
  },
  output: {
    path: path.resolve(__dirname, 'build'), // you can change this if needed
    filename: '[name].js',
  },
};
