<?php

namespace liansu\view;

use liansu\core\App;
use liansu\view\interface_\ViewHandlerInterface;

class View
{
    public static function fetch(ViewHandlerInterface $viewHandler, $file, $args = null)
    {
        return $viewHandler->fetch($file, $args);
    }

    public static function getFile($rawFile)
    {
        if (!$rawFile) {
            return self::getDefaultFile();
        }
        $runner = App::instance()->getRunner(); // 秒啊（指直接调用实例化后对象获取默认的runner及action）
        if ($baseNamespace = App::instance()->getBaseNamespace()) {
            $runner = substr($runner, strlen($baseNamespace) + 1);
        }
        $action = App::instance()->getAction();

        $file = rtrim(str_replace('.', DIRECTORY_SEPARATOR, $rawFile), DIRECTORY_SEPARATOR);
        if (strpos($file, DIRECTORY_SEPARATOR) === false) { // A => A/(defaultAction)
            $file = $file . DIRECTORY_SEPARATOR . $action;
        } else if (strpos($file, DIRECTORY_SEPARATOR) === 0) { // /A => (defaultRunner)/A
            $file = $runner . $file;
        }

        return $file;
    }

    protected static function getDefaultFile()
    {
        $runner = App::instance()->getRunner(); // 秒啊（指直接调用实例化后对象获取默认的runner及action）
        if ($baseNamespace = App::instance()->getBaseNamespace()) {
            $runner = substr($runner, strlen($baseNamespace) + 1);
        }
        $action = App::instance()->getAction();
        return $runner . DIRECTORY_SEPARATOR . $action;
    }
}
