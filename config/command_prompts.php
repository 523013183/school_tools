<?php
$commands = json_decode(file_get_contents(base_path('resources') . "/data/commands.json"), true);
return $commands;