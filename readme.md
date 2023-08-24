### 简介
dcat字段扩展：地图拖拽设置xy坐标

![dcat自定义字段，xy坐标拖拽](https://cdn.learnku.com/uploads/images/202308/24/78338/OuxMTeksQA.png!large)


### 使用

1.下载并复制到根目录，暂时没做composer包

2.注册扩展：`app/Admin/bootstrap.php`中`Form::extend('xyMap', \App\Admin\Extensions\Form\XyMap::class);`

3.控制器的form中使用(需要数据库有xy字段)
`$form->xyMap('x','y','坐标');`

4.设置背景图片和marker图片：
可以替换bg.png，也可以用`->bg($url)`和`->marker($url)`

5.设置高度：
`->height('400px')`

### 地址

[gitee仓库](https://gitee.com/aoding9/dcat-xy-map)