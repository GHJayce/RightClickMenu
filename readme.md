
# 生成Windows右键菜单的注册文件

右键菜单生成器v2.0！可以将windows程序设置在鼠标的右键菜单上，支持层级菜单。

主要生成右键菜单的注册表文件（含`创建`、`移除`两个文件）。

> 这个应用是拿来练习PHP设计模式的实例，为了更好地理解设计模式。

> 用到的设计模式：依赖注入 + 组合模式 + 桥梁模式 + 门面模式 + 原型模式。

> 更好的实现方式应该是直接与操作系统进行交互，减少用户的麻烦，更直接的操作右键菜单。

## 运行环境

> 建议本地运行，暂无官方可供在线使用。

PHP >= 5.4，可用以下命令启动，然后访问：http://localhost:8080

```shell
php -S localhost:8080
```

或者另外的运行方式：[集成PHP环境的浏览器](https://github.com/cztomczak/phpdesktop/releases/tag/chrome-v57.0-rc)。

## 演示

![应用使用演示](https://raw.githubusercontent.com/GHJayce/Assets/master/RightClickMenu/demo_v2.0.0.gif)

## 线上浏览

[https://ghjayce.github.io/RightClickMenu/](https://ghjayce.github.io/RightClickMenu/)

## 前端项目

[right-click-menu-front](https://github.com/GHJayce/right-click-menu-front)
