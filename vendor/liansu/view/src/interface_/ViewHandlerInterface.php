<?php

namespace liansu\view\interface_;


interface ViewHandlerInterface
{
    public function initialize($config);

    public function fetch($file, $args = null);

    public function getParsedContent($content);
}
