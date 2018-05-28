## xhprof——PHP performance testing plugin
---
PHP code performance plugin

## configuration

### 1. Install xhprof
#### 1. Get source code
You can get the source code from website [https://github.com/longxinH/xhprof](https://github.com/longxinH/xhprof),
And follow next steps to install on centos 6.5. 

#### 2. install
```
cd xhprof-master/extension/
sudo /usr/bin/phpize
sudo ./configure --with-php-config=/usr/bin/php-config --enable-xhprof
sudo make && make install
```

#### 3. load by php extentsion

```
php.ini 引入 xhprof.so，并重启php-fpm
make install 成功后会得到xhprof.so的目录，/usr/lib64/php/modules/xhprof.so

修改php.ini文件， vim /etc/php.ini（路径根据自己的配置）
extension=/usr/lib64/php/modules/xhprof.so //注意so文件的路径
xhprof.output_dir=/tmp/xhprof  //此配置用于存放分析数据

sudo service php-fpm restart
```

### 2. Config the xhprof-html from nginx visit
### 3. Add xhprof.so and xhprof file output to php.ini
