<?php

namespace liansu\core_plus;


class App extends \liansu\core\App
{
    public function run()
    {
        $this->addInitItems(\liansu\core_plus\init\CorePlus::class);

        parent::run();
    }
}
