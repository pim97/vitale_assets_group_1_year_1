<?php

return array(
    'dsn' => env('https://83947d64d9cb450ca5ac51fedae81d30:841ac69fc39a4bb38f4425cb3f4d667e@sentry.io/1206481'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,

    // Capture default user context
    'user_context' => false,
);
