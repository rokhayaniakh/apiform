<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXtieZdQ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXtieZdQ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXtieZdQ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXtieZdQ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerXtieZdQ\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'XtieZdQ',
    'container.build_id' => 'ae7b8f25',
    'container.build_time' => 1567538799,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXtieZdQ');
