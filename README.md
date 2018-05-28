## xhprof——PHP performance testing plugin
PHP code performance plugin

## configuration

### 1. Install xhprof
#### 1. Get source code
You can get the source code from website [https://github.com/longxinH/xhprof](https://github.com/longxinH/xhprof),
and follow steps 2 to install on centos 6.5. 

#### 2. Install xhprof
```
cd xhprof-master/extension/
sudo /usr/bin/phpize
sudo ./configure --with-php-config=/usr/bin/php-config --enable-xhprof
sudo make && make install
```

#### 3. Load as php extentsion

You will get the path of xhprof.so, for install /usr/lib64/php/modules/xhprof.so after command make install
open the php.ini file by vim, 

```
vim /etc/php.ini  
extension=/usr/lib64/php/modules/xhprof.so 
xhprof.output_dir=/tmp/xhprof // this config is used to analyze the xhprof data

sudo service php-fpm restart
```

### 2. Config the xhprof-html from nginx visit
Config the nginx so that you can visit the xhprof data by table and graph.
```

server {
    listen       13000;
    location  / { 
        root           xhprof_html directory path;
        try_files $uri $uri/ /index.php?$query_string;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_param  SCRIPT_FILENAME   $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }   
}

```

### 3. Add xhprof.so and xhprof file output to php.ini
Add xhprof.so and output destination file to php.ini

```
extension=/usr/lib64/php/modules/xhprof.so
xhprof.output_dir=/tmp/xhprof //will generate data file in /tmp/xhprof directory

```

###4. How to use the plugin

####1. execute the command below
```
composer require silly/package dev-master
```
then you will find the item in composer.json below require

```
"silly/package": "dev-master"

```
####2. Use the Xhprof class in your code
```
use silly\package\Xhprof;
$xf = new Xhprof();

$xh->xhprof_start();

....your code....

$data = $xh->xhprof_end();
$host = 'xxxx/index.php?run='; //the path you visit xhprof_html directory
$xf->xhprof_display($data, $host);
```
Then will print the url, for instance (http://your_host/index.php?run=5b0c1bf8a8875&source=xhprof),
just open it in browser, it will show the data in tablelist and click the [View Full Callgraph] link, 
you will see the function call links. Just care about the links with yellow and red color and optimize them.

