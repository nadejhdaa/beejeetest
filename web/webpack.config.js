const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');

module.exports = {
  entry: './src/app.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'bundle.js'
  },
  mode: 'development',
	module: {
	  rules: [
	    {
	      test: /\.scss$/,
	      use: ExtractTextPlugin.extract({
	        fallback: 'style-loader',
	        use: ['css-loader', 'sass-loader']
	      })
	    },
	    {
	    	test: /\.svg$/,
        use: 'file-loader'
	    },
	    {
	    	test: /\.(jpg|JPG|jpeg|png|gif|mp3|ttf|woff2|woff|eot)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
	    	use: {
					loader: "file-loader",
					options: {
						name: "[name].[ext]", 
					}
				}
	    }
	  ]
	},
	plugins: [
	  new ExtractTextPlugin('style.css')
	],
	externals: {
    // require("jquery") is external and available
    //  on the global var jQuery
    "jquery": "jQuery"
  }
};