<?php

namespace Myerscode\Utilities\Numbers\Enums;

enum FileSizeUnit: string
{
    case B = 'B';

    case GB = 'GB';

    case KB = 'KB';

    case MB = 'MB';

    case PB = 'PB';

    case TB = 'TB';

    /**
     * The number of bytes in a single unit of this size
     */
    public function bytes(): int
    {
        return 1024 ** $this->exponent();
    }

    /**
     * The power of 1024 that this unit represents
     */
    public function exponent(): int
    {
        return match ($this) {
            self::B => 0,
            self::KB => 1,
            self::MB => 2,
            self::GB => 3,
            self::TB => 4,
            self::PB => 5,
        };
    }

    /**
     * The human readable suffix for this unit
     */
    public function suffix(): string
    {
        return $this->value;
    }
}
