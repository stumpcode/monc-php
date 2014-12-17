<?php

function test($val, $expect, $msg) {
    if ($val != $expect)
        throw new Exception($msg);
}

$cache = Alibaba::Cache();

$user = array (
    "name" => "ace",
    "age" => 1,
    "sex" => "male"
);

test($cache->set('user', $user), true, 'Set cache failed');
test($cache->get('user')['age'], 1, 'Get cache failed');

test($cache->set('foo', 1), true, 'Set cache failed');
test($cache->add('foo', 1), false, 'Add cache failed');
test($cache->delete('foo'), true, 'Add cache failed');

test($cache->add('foo', 1), true, 'Add cache failed');
test($cache->increment('foo', 1), 2, 'increment cache failed');
test($cache->decrement('foo', 1), 1, 'decrement cache failed');

echo '测试完成.';
