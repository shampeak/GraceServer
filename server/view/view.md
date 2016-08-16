## view
#### 视图显示View ####

##### 一. GraceStand默认的视图显示是Smarty，如果你不想使用前端框架，可以使用view视图 #####

+ 如果你想使用和smarty一样的快捷方法，做以下修改

  /Application/Helper.php   
  ```
  view方法（去掉下方代码注释或添加）
  
  $views = server('View')->router(req('Router'));
  $views->display($tpl, $data);
  
  //smarty视图显示注释掉
  //server('Smarty')->router(req('Router'))->display($tpl,$data);
  
  ```
  
+ 添加view的配置文件
  
  /Application/Config/View.php

  ```
  return[
    'viewpath'=>'../App/Views/'
  ];
  
  ```
  
+ 注册view的配置文件

  /Application/Config/Server.php
  
  ```
  'FileReflect' =>[
        'View' => 'View.php'
  ]
  ```
  
##### 二. 视图显示 #####

+ view($view_file_name=null,data=[])
  ```
  view('test',[
            'a'=>'nsc'
        ]);
        
        
  注释：
      1. 需要修改快捷参数view的默认显示 （1中第一部分）
      2. 参数：第一个参数视图文件名（test代表test.php文件），第二个参数显示数据
      3. 显示视图必须为同一控制器内的视图
      4. 如果所请求的方法名同视图名相同，可省略第一个参数
        
   ```
   
+ fetch()显示页面数据量比较大的情况下使用(加入缓冲区)
  ```
  php.ini  
  
  output_buffering = 4096
  修改参数更改缓冲数据量大小（即缓冲多大时输出浏览器显示）
  
  $views = server('View')->router(req('Router'));
  $views->fetch($view_file_name=null, $data=[]);
  
  ```
  
+ display()如果你不想使用快捷方法view(),你可以使用以下方式调用视图
  
  ```
  $views = server('View')->router(req('Router'));
  $views->display($view_file_name=null, $data=[]);
  
  ```