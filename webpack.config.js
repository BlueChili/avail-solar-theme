const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const path = require('path');
const CopyPlugin = require("copy-webpack-plugin");
const sass = require('sass');
const WatchExternalFilesPlugin = require('webpack-watch-external-files-plugin');

module.exports = {
  performance: {
    hints: false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000
  },

  entry: {
      // Custom
      'site'                    : './source/js/site.js',
      'customizer'              : './source/js/customizer.js',
      'focus-visible'           : './source/js/focus-visible.js',
  },

  output: {
    path: path.resolve(__dirname, 'assets', 'js'),
    filename: '[name].js'
  },
  
  plugins: [
    new WatchExternalFilesPlugin({
      files: ['./source/scss/**/*.scss'],
    }),
    new MiniCssExtractPlugin(),
    new CopyPlugin({
      patterns: [
        // js files
        { from: "node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" },
        { from: "node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map" },
        { from: "node_modules/aos/dist/aos.js" },
        { from: "node_modules/lazysizes/lazysizes.min.js" },
        { from: "node_modules/lax.js/lib/lax.min.js" },
        { from: "node_modules/lazysizes/plugins/object-fit/ls.object-fit.min.js", to: "./plugins/object-fit/" },
        { from: "node_modules/swiper/swiper-bundle.min.js" },
        { from: "node_modules/swiper/swiper-bundle.min.js.map" },

        // images
        { 
          from: "source/images",
          to: "../images",
          globOptions: {
            ignore: ["**/*.php"],
          },
        },

        // css files
        { from: "node_modules/swiper/swiper-bundle.min.css", to: "../css" },
        { from: "node_modules/swiper/swiper.min.css", to: "../css" },
        { from: "node_modules/aos/dist/aos.css", to: "../css" },

        {
          from: 'source/scss/style.scss', to: '../css/style.css',
          transform: (content, path) => {
            return sass.compile(path).css
          },
        },

        {
          from: 'source/scss/editor-style.scss', to: '../css/editor-style.css',
          transform: (content, path) => {
            return sass.compile(path).css
          },
        },
      ],
      options: {
        concurrency: 100,
      },
    }),
  ],
  
  optimization: {
    minimizer: [
      new CssMinimizerPlugin(),
      new ImageMinimizerPlugin({
        minimizer: {
          implementation: ImageMinimizerPlugin.imageminMinify,
          options: {
            // Lossless optimization with custom option
            // Feel free to experiment with options for better result for you
            plugins: [
              ["gifsicle", { interlaced: true }],
              ["jpegtran", { progressive: true }],
              ["optipng", { optimizationLevel: 5 }],
              // Svgo configuration here https://github.com/svg/svgo#configuration
              [
                "svgo",
                {
                  plugins: [
                    {
                      name: "preset-default",
                      params: {
                        overrides: {
                          removeViewBox: false,
                          addAttributesToSVGElement: {
                            params: {
                              attributes: [
                                { xmlns: "http://www.w3.org/2000/svg" },
                              ],
                            },
                          },
                        },
                      },
                    },
                  ],
                },
              ],
            ],
          },
        },
      }),
    ],
  },
};
