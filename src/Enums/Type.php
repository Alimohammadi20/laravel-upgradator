<?php

namespace SystemUpdator\Enums;

enum Type : string
{
    case UPGRADE = 'upgrade';
    case DOWNGRADE = 'downgrade';
}
