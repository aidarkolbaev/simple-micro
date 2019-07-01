<?php

namespace Core\Interfaces;


interface AppInterface
{
    /**
     * @return void
     * @throws \Exception
     */
    public function handle(): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function GET(string $path, array $handler): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function POST(string $path, array $handler): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function PUT(string $path, array $handler): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function DELETE(string $path, array $handler): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function PATCH(string $path, array $handler): void;

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function HEAD(string $path, array $handler): void;
}