'use strict';
/* пути к исходным файлам (src), к готовым файлам (build), а также к тем, за изменениями которых нужно наблюдать (watch) */
var path = {
  dist: {
    public: 'public_html/public/dist/',
    views: 'public_html/app/views/dist/',
    test: 'public_html/test/dist/'
  },
  src: {
    public: 'public_html/public/src/',
    views: 'public_html/app/views/src/',
    test: 'public_html/test/src/'
  },
  type: {
    html: '**/[^_]*.+(html|tpl|php)',
    js: '**/[^_]*.js',
    css: '**/[^_]*.+(sass|scss)'
  }
};

/* подключаем gulp и плагины */
var gulp = require('gulp'),  // подключаем Gulp
  plumber = require('gulp-plumber'), // модуль для отслеживания ошибок
  rigger = require('gulp-rigger'), // модуль для импорта содержимого одного файла в другой
  sourcemaps = require('gulp-sourcemaps'), // модуль для генерации карты исходных файлов
  sass = require('gulp-sass'), // модуль для компиляции SASS (SCSS) в CSS
  autoprefixer = require('gulp-autoprefixer'), // модуль для автоматической установки автопрефиксов
  cleanCSS = require('gulp-clean-css'), // плагин для минимизации CSS
  uglify = require('gulp-uglify'), // модуль для минимизации JavaScript
  cache = require('gulp-cache'), // модуль для кэширования
  rimraf = require('gulp-rimraf'), // плагин для удаления файлов и каталогов,
  babel = require('gulp-babel'), //перевод с новых стандартов js в старые для кроссбраузерности
  htmlmin = require('gulp-htmlmin'), //минификация html
  args = require('yargs').argv;
// rename = require('gulp-rename');

/* задачи */
var key = args.key || 'public';
console.log(key);
// сбор html
gulp.task('html:build', function () {
  return gulp.src(path.src[key] + path.type.html) // выбор всех html файлов по указанному пути
    .pipe(plumber()) // отслеживание ошибок
    .pipe(rigger()) // импорт вложений
    // .pipe(htmlmin({
    //   collapseWhitespace: true, // удаляем все переносы
    //   removeComments: true // удаляем все комментарии
    // }))
    .pipe(gulp.dest(path.dist[key])) // выкладывание готовых файлов
});

// сбор стилей
gulp.task('css:build', function () {
  return gulp.src(path.src[key] + path.type.css) // получим все стили
    .pipe(plumber()) // для отслеживания ошибок
    .pipe(sourcemaps.init()) // инициализируем sourcemap
    .pipe(sass()) // scss -> css
    .pipe(autoprefixer({ //префиксы
      overrideBrowserslist: ['last 25 versions'],
      cascade: false
    }))
    .pipe(cleanCSS()) // минимизируем CSS
    .pipe(sourcemaps.write('./')) // записываем sourcemap
    .pipe(gulp.dest(path.dist[key])) // выгружаем в build
});

// сбор js
gulp.task('js:build', function () {
  return gulp.src(path.src[key] + path.type.js) // получим файлы js
    .pipe(plumber()) // для отслеживания ошибок
    .pipe(rigger()) // импортируем все указанные файлы js
    .pipe(babel({
      "presets": [
        [
          "@babel/preset-env",
          {
            "modules": "false"
          }
        ]
      ]
    }))
    .pipe(sourcemaps.init()) //инициализируем sourcemap
    .pipe(uglify()) // минимизируем js
    .pipe(sourcemaps.write('./')) //  записываем sourcemap
    .pipe(gulp.dest(path.dist[key])) // положим готовый файл
});

// удаление js
gulp.task('js:clean', function () {
  return gulp.src(path.dist[key] + path.type.js, { read: false })
    .pipe(rimraf());
});

// удаление html
gulp.task('html:clean', function () {
  return gulp.src(path.dist[key] + path.type.html, { read: false })
    .pipe(rimraf());
});

// удаление css
gulp.task('css:clean', function () {
  return gulp.src(path.dist[key] + path.type.css, { read: false })
    .pipe(rimraf());
});

// удаление каталога dist 
gulp.task('clean', function () {
  return gulp.src(path.dist[key] + '*', { read: false })
    .pipe(rimraf());
});


// сборка
gulp.task('build',
  gulp.series('clean',
    gulp.parallel(
      'css:build',
      'js:build',
      'html:build'
    )
  )
);

// запуск задач при изменении файлов
gulp.task('watch', function () {
    gulp.watch(path.src[key] + path.type.css, gulp.series('css:build'));
    gulp.watch(path.src[key] + path.type.js, gulp.series('js:build'));
    gulp.watch(path.src[key] + path.type.html, gulp.series('html:build'));   
});
// очистка кэша
gulp.task('cache:clear', async function () {
  cache.clearAll();
});