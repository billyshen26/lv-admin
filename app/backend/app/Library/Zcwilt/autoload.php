<?php

    // https://github.com/zcwilt/rest-api  好项目，可惜star太少
    date_default_timezone_set('PRC');

    class Autoload
    {

        public static $_scanDir = array(
            'Controllers/',
            'Exceptions/',
            'Parsers/'
        );

        public static function __autoload($className)
        {
            self::scanDir(self::$_scanDir,$className);
        }

        public static function scanDir($scanDir,$className)
        {
            $_rootDir = dirname(__FILE__).'/';

            $_namespace = 'Zcwilt\\Api\\';
            $className = str_replace($_namespace,'',$className);
            $className = str_replace('\\',DIRECTORY_SEPARATOR,$className);
            // 根目录如果也有类
            if (file_exists($_rootDir.$className.'.php'))
            {
                require_once $_rootDir.$className.'.php';
            }
            foreach ($scanDir as $index => $item) {
                if (file_exists($_rootDir.$item.$className.'.php'))
                {
                    require_once $_rootDir.$item.$className.'.php';
                }
            }
        }
    }

    spl_autoload_register(array('Autoload','__autoload')); // 当自己实现一个__autoload方法时，需要将自己的autoload方法替换php中的__autoload方法，使用spl_autoload_register（array('自己实现的类名','自己实现的autoload方法'))。


