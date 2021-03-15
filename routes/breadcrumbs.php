<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Landing
Breadcrumbs::for('landing', function ($trail) {
    $trail->push('Panel Website', route('admin.index'));
});
