<?php
/**
 * just eval content
 * $route ['id','method', 'route_type', 'content_type', 'content', 'retry', 'retry_delay', 'timeout']
 * ignoring 'content_type','method', 'retry', 'retry_delay', 'timeout'
 */

header('Content-Type: '.$route['content_type']);

eval("?>".$route['content']);