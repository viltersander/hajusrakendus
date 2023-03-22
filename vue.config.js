module.exports = {
    runtimeCompiler: true,
    configureWebpack: {
      resolve: {
        alias: {
          '@': path.resolve(__dirname, 'resources/js')
        },
        extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx', '.json']
      }
    }
  }