<?php

declare(strict_types=1);

namespace DaggerModule;

use Dagger\Attribute\DaggerFunction;
use Dagger\Attribute\DaggerObject;
use Dagger\Attribute\Doc;
use Dagger\Container;
use Dagger\Directory;

use function Dagger\dag;

#[DaggerObject]
class MyModule
{
    #[DaggerFunction]
    #[Doc('Return a container with a specified directory and an additional file')]
    public function copyAndModifyDirectory(Directory $source): Container
    {
        return dag()
            ->container()
            ->from('alpine:latest')
            ->withDirectory('/src', $source)
            ->withExec(['/bin/sh', '-c', `echo foo > /src/foo`]);
    }
}
