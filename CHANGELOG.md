### ChangeLog
[+]Add [-]Delete [^]Update [#]Fix 【】Important

### 2.0.3 (2016-07-19)
* 【#】Fix bug run() function in jiashu.php
* 【#】Fix bug update() and error() functions in lib/mysql.php

### 2.0.2 (2016-04-01)
* 【+】Add new Function loadCustomLib() It can load your custom class or function file

### 2.0.1 (2016-02-14)
* 【+】Add Global Function JSFW() It can get framework instance
* 【#】framework is singleton class now

### 2.0.0 (2016-01-13)
* 【^】refactoring Model class, support chain call, support ORM for single table and native SQL
* 【^】framework is not singleton class now
* 【^】you must register your custom variables via setTplData() first, it can be used in template file
* 【^】router automatically recognizes 2 routing rules:(1)http://domain/index.php?c=a&a=b(2)http://domain/index.php/a/b
* 【-】Remove modules in the routing layer, now only controllers and actions

### 1.0.0 (2014-12-10)
* 【+】initial project and open source

---

### 修改记录
[+]新增 [-]删除 [^]升级 [#]修复 【】重要

### 2.0.3 (2016-07-19)
* 【#】修改jiashu.php文件里的run()函数
* 【#】修改lib/mysql.php文件里的update()和error()俩函数

### 2.0.2 (2016-04-01)
* 【+】增加新的函数loadCustomLib() 读取自定义的类或者函数

### 2.0.1 (2016-02-14)
* 【+】增加全局函数JSFW() 能够得到框架实例对象
* 【#】框架改为单例类

### 2.0.0 (2016-01-13)
* 【^】重构数据库模型类，支持链式调用，支持单数据库表ORM操作方式同时也支持原生SQL操作数据库
* 【^】框架类改成非单例类
* 【^】传递给模版的变量必须通过setTplData()函数注册，才可在模版文件中使用
* 【^】路由功能自动识别两种路由规则:(1)http://domain/index.php?c=a&a=b(2)http://domain/index.php/a/b
* 【-】删除路由中的模块层级，现在只有控制器和动作

### 1.0.0 (2014-12-10)
* 【+】项目启动并开源
