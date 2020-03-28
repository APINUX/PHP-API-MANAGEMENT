<?php
/**
 * PHP Processor will execute PHP Code you provide
 */

header('Content-Type: '.$route['content_type']);

eval("?>".$route['content']);