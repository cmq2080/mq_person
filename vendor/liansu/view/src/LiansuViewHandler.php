<?php

namespace liansu\view;

use liansu\core\App;
use liansu\core\Response;
use liansu\template\interface_\TemplateTranslatorInterface;
use liansu\view\interface_\ViewHandlerInterface;

class LiansuViewHandler implements ViewHandlerInterface
{
    protected $tplDir = '';
    protected $cacheDir = '';
    protected $extensions = ['php', 'html', 'htm'];
    protected $templateTranslator = null;

    public function initialize($config)
    {
        if (isset($config['tpl_dir']) && $config['tpl_dir']) {
            $this->tplDir = $config['tpl_dir'];
        }
        $this->tplDir = $this->tplDir ?: App::instance()->rootDirectory . DIRECTORY_SEPARATOR . 'view';

        if (isset($config['cache_dir']) && $config['cache_dir']) {
            $this->cacheDir = $config['cache_dir'];
        }
        $this->cacheDir = $this->cacheDir ?: App::instance()->runtimeDirectory . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'view';

        if (isset($config['allowed_ext']) && $config['allowed_ext']) {
            if (!is_array($config['allowed_ext'])) {
                $config['allowed_ext'] = explode(',', $config['allowed_ext']);
            }
            $this->extensions = $config['allowed_ext'];
        }

        if (isset($config['template_translator']) && $config['template_translator']) {
            $this->templateTranslator = $config['template_translator'];
        }
    }

    public function fetch($file, $args = null)
    {
        $parsedFile = $this->getParsedFile($file);
        // 秒啊（指直接用ob方法获取执行后的数据流，解决了其中的变量实值输出的问题，外加对extract方法的调用）
        ob_start();

        extract($args);
        include $parsedFile;
        $finalContent = ob_get_contents();

        ob_clean();

        return $finalContent;
    }

    public function display($file, $args = null)
    {
        Response::print($this->fetch($file, $args));
    }

    protected function getParsedFile($file)
    {
        $tplFile = $this->getTplFile($file);
        if ($tplFile === null) {
            throw new \Exception('No Template File Found: ' . $this->tplDir . DIRECTORY_SEPARATOR . $file . '.(' . implode('|', $this->extensions) . ')');
        }

        $key = md5($file);
        $cacheFile = $this->cacheDir . DIRECTORY_SEPARATOR . $key . '.php';
        if (is_file($cacheFile) && filemtime($cacheFile) > filemtime($tplFile)) { // 1.缓存文件存在；2-缓存文件修改时间晚于模板文件修改时间。则缓存有效
            return $cacheFile; // 秒啊（指判断缓存文件的方法及其高明）
        }

        $parsedContent = $this->getParsedContent(file_get_contents($tplFile));
        if (!is_dir($this->cacheDir)) { // 没有缓存目录？那就建一个呗
            mkdir($this->cacheDir, 0777, true);
        }
        file_put_contents($cacheFile, $parsedContent);

        return $cacheFile;
    }

    protected function getTplFile($file)
    {
        $tplFile = null;
        foreach ($this->extensions as $extension) {
            if (is_file($this->tplDir . DIRECTORY_SEPARATOR . $file . '.' . $extension) === true) {
                $tplFile = $this->tplDir . DIRECTORY_SEPARATOR . $file . '.' . $extension;
            }
        }
        return $tplFile;
    }

    public function getParsedContent($content)
    {
        if (!$this->templateTranslator) {
            $this->templateTranslator = new \liansu\template\LiansuTemplateTranslator();
        }
        if (is_string($this->templateTranslator)) { // 如果没有传入实例化对象的话，当即进行实例化
            $driver = $this->templateTranslator;
            if (!class_exists($driver)) {
                throw new \Exception('No Template Translator Found');
            }
            $this->templateTranslator = new $driver();
        }

        if (!($this->templateTranslator instanceof TemplateTranslatorInterface)) {
            throw new \Exception('Template Translator IS NOT The Instance Of TemplateTranslatorInterface');
        }

        $parsedContent = $this->templateTranslator->translate($content);
        return $parsedContent;
    }
}
