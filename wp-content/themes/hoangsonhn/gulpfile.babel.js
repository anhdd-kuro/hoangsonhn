import gulp from "gulp";
import postcss from "gulp-postcss";
import browserSync from "browser-sync";
import connect from "gulp-connect-php";
import webpack from "webpack-stream";

const paths = {
  styles: {
    src: ["./src/styles/main.css"],
    dest: "./assets/dist/css/",
    watch: "src/styles/**/*.css",
  },
  scripts: {
    src: ["./src/scripts/main.js"],
    dest: "./assets/dist/js/",
  },
  images: {
    src: "assets/images/*.*",
  },
  views: {
    src: "**/*.{php,html}",
  },
};

export function styles() {
  return gulp.src(paths.styles.src)
    .pipe(postcss())
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream())
}

export function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(webpack({
      mode: 'production', // or 'development'
      module: {
        rules: [
          {
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env'],
              },
            },
          },
        ],
      },
    }))
    .pipe(gulp.dest(paths.scripts.dest));
}

// Custom middleware function to disable caching
function disableCache(req, res, next) {
  res.setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
  res.setHeader('Pragma', 'no-cache');
  res.setHeader('Expires', '0');
  res.setHeader('Surrogate-Control', 'no-store');
  next();
}

export function syncBrowser() {
  return connect.server(
    {
      base: "./",
      port: 3456,
    },
    () => {
      browserSync({
        proxy: `localhost:8080`,
        reloadOnRestart: true,
        middleware: [disableCache]
      });
    }
  );
}

function watch() {
  gulp.watch([paths.styles.watch, paths.views.src], styles);
  gulp.watch([...paths.scripts.src], scripts);
  gulp.watch([paths.views.src, paths.images.src], (done) => {
    browserSync.reload();
    done();
  });
}

export const buildAndWatch = gulp.series(
  gulp.parallel(styles, scripts),
  gulp.parallel(syncBrowser, watch)
);

/*
 * Export a default task
 */
const build = gulp.series(gulp.parallel(styles, scripts));

export default build;
