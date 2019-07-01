<?php

namespace Core;


use Core\Interfaces\AppFactoryInterface;
use Core\Interfaces\AppInterface;

class MicroAppFactory implements AppFactoryInterface
{

    /** @return AppInterface */
    public function createApp(): AppInterface
    {
        return new MicroApp(new Router());
    }
}