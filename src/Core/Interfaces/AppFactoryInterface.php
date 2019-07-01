<?php

namespace Core\Interfaces;


interface AppFactoryInterface
{
    /** @return AppInterface */
    public function createApp(): AppInterface;
}