const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");

// 获取所有 CSS 文件的路径
const scssFiles = glob.sync("resources/scss/**/*.scss");
const jsFiles = glob.sync("resources/js/**/*.js");

mix.webpackConfig({
    stats: {
        children: true,
    },
});

// 使用 mix.sass() 方法编译每个 SCSS 文件
scssFiles.forEach(file => {
    // 获取输入文件的相对路径
    const relativePath = path.relative("resources/scss", file);
    // 去掉输入文件的后缀名和.scss后缀
    const fileNameWithoutExtension = path.basename(relativePath, ".scss");
    // 设置输出文件的名称为去掉后缀名的文件名，并保持目录结构
    mix.sass(file, `public/css/${path.dirname(relativePath)}/${fileNameWithoutExtension}.css`);
});

// 使用 mix.js() 方法编译每个 js 文件
jsFiles.forEach(file => {
    // 获取输入文件的相对路径
    const relativePath = path.relative("resources/js", file);
    // 去掉输入文件的后缀名和.scss后缀
    const fileNameWithoutExtension = path.basename(relativePath, ".js");
    // 设置输出文件的名称为去掉后缀名的文件名，并保持目录结构
    mix.js(file, `public/js/${path.dirname(relativePath)}/${fileNameWithoutExtension}.js`);
});