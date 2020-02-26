<?php
/**
 * just echo content
 * $route ['id','method', 'route_type', 'content_type', 'content', 'retry', 'retry_delay', 'timeout']
 * ignoring 'method', 'retry', 'retry_delay', 'timeout'
 */

header('Content-Type: '.$route['content_type']);

echo $route['content'];