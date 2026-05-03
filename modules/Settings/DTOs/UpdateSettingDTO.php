<?php

namespace Modules\Settings\DTOs;

class UpdateSettingDTO
{
    public function __construct(
        public int $pomodoro,
        public int $break,
        public bool $auto_check,
        public bool $sound_enabled,
        public string $theme_color,
    ) {}
}
