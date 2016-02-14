### This document I write in English and Chinese, my English is not good, please bear with me
### 这个文档我用英文和中文两个语言来写,我英文不好,请多包涵


### English:

> My name is Gu Sen, from China, i'm a web programmer and I has done a number of projects with java, php and asp, but my favorite language is PHP.

> The jiashu framework is a simple, small, MVC PHP framework. I use my son's name to name this framework, it mean that a good hope that this program can grow and can fit in your web application, in Chinese, "jia shu" represents an adaptation it can be very good in the soil of the tree (from Songs in the article), I hope my child can grow up healthy, so I put this name in this open-source project, I also hope that this program can grow up healthy and can help you to developing your web program.

> This PHP framework is completely free, and you can free for commercial projects. Procedural framework is relatively small, because I want to develop a web framework as simple as possible, so that you can speed up program execution time and reduce system the memory overhead.

> The framework currently includes Processing workflow and a common database model class. This model class can operate multiple kind of databases (though I only implemented mysql model class).
Processing workflow is:

> 1. We assume that the user's url request is this form: http://domain/index.php/a/b, "a" is parsed into a controller name, "b" is parsed into a function name of controller (action name), the path eventually framework calls is: "your site root/controller/a.php" and execute b().
> 2. If you want to show a page (call render function), it will be called: "your site root/views/xxx/xxx.php", this php file is a template file of this page.
> 3. All required operations on the database will first create a database table for each model file, they will be placed in the "your site root/model/", and the need to inheritance model class.
> 4. Web program after reading the startup configuration file, you can specify your configuration file, read the framework of the default configuration file for detail.

> #### jiashu framework advantages:
> 1. You can put framework files out of your site root directory, it will enhance security of your website.
> 2. Your configuration file also out of your site root directory, you can protect your configuration information will not be leaked.
> 3. The framework's concept is small and efficient, so I minimize the unnecessary code in this framework. In order to make your web application can handle more client requests.

> The program also includes the demo program, you can learn this framework quickly.

> If you have any suggestions for my program, please testify, my Email: gusen1982@gmail.com
> Thank you.

---


### 中文:

> 我叫顾森,来自中国,是一名web程序员,曾经做过java,php和asp的网站,但是我最喜欢php语言.

> jiashu(嘉树)框架是一个简单的,小型的,MVC的PHP框架.我用我儿子的名字来命名这个框架,意思就是希望这个程序可以很好的成长并能适合您的web程序中,在中文里"嘉树"代表了一颗可以非常好的适应它所在土壤的树(取自屈原的楚辞里的一篇文章),我取这个名字希望我的孩子可以健康的成长,所以我把这个名字用在了我的这个开源项目中,我也同样希望这个程序可以健康的成长,能够帮助使用者很好的开发他的web程序.

> 这个PHP框架是完全免费的,并且您可以免费的用于商业项目中.框架的程序比较少,因为我希望开发出一个尽可能简单的web框架来,这样可以加快程序的执行速度,并且减少系统的内存开销,所以我这个项目的理念是尽可能的简单,高效.

> 这个框架目前仅仅包括了程序工作流的处理,还有一个通用的数据库模型类,该类可以实现多个数据库的操作模型(虽然我只实现了mysql数据库的实现).
工作流的处理是这样的:

> 1. 我们假设用户的url地址是这种形式的:http://域名/index.php/a/b,那么a被解析成控制器名,b则是控制器中的函数名(动作名),最终框架会调用的路径是:您网站根目录/controller/a.php中的b函数
> 2. 处理完成后如果要显示出来(调用了render函数),就会调用:您网站根目录/views/指定目录/指定文件.php,该文件就是这个页面的模版文件.
> 3. 所有需要对数据库的操作,都会先要对每一个数据库表创建一个模型文件,它们都会放在您网站根目录中model/下,并需要继承框架的model类.
> 4. web程序启动后会读取配置文件,您可以指定您的配置文件,配置文件的详细项目在框架默认的配置文件中有详细的说明.

> #### jiashu框架的优点:
> 1. 您可以把框架的程序文件放到您web程序根目录之外的目录,这样可以保证您的网站程序的安全.
> 2. 您的配置文件也可以放在web程序根目录之外,在调用框架的时候给它指定路径即可,这样可以保护您的配置信息不会被泄露.

> 3. 框架的理念是小巧和高效,所以我在开发的时候尽可能的减少不必要的代码.为了让您的web程序可以处理更多的客户端请求(我会在后面的版本中增加一些工具类,需要用的时候才去加载它)

> 程序也包含了demo程序,您可以很快掌握这个框架的使用.

> 如果您对我的程序有什么建议,请指证,我的邮箱:gusen1982@gmail.com
> 谢谢.
