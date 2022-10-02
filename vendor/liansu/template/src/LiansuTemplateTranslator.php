<?php

namespace liansu\template;

use liansu\template\interface_\TemplateTranslatorInterface;

class LiansuTemplateTranslator implements TemplateTranslatorInterface
{
    public function translate($content)
    {
        return $content;
    }
}
