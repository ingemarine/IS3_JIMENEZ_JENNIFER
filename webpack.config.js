const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/auth/login' : './src/js/auth/login.js',
    'js/productos/estadisticas' : './src/js/productos/estadisticas.js',
    'js/mapa/index' : './src/js/mapa/index.js',
    'js/envios/index' : './src/js/envios/index.js',
    'js/envios/estadisticas' : './src/js/envios/estadisticas.js',
    'js/envios/mapa' : './src/js/envios/mapa.js',


    // 'js/aplicacion/index' : './src/js/aplicacion/index.js',
    // 'js/roles/index' : './src/js/roles/index.js',
    // 'js/user/index' : './src/js/users/index.js',
    'js/permiso/index' : './src/js/permiso/index.js',
 
    'js/auth/registro': './src/js/auth/registro.js', 
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ]
  }
};