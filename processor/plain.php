<?php
/**
 * PLAIN Processor, will show content based your setup
 */

header('Content-Type: '.$route['content_type']);

echo $route['content'];