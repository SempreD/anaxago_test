<?php

namespace Anaxago\CoreBundle\Enum;

abstract class StatutEnum
{
    const STATUT_FINANCE = "financé";
    const STATUT_NON_FINANCE = "non-financé";

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::STATUT_FINANCE,
            self::STATUT_NON_FINANCE,
        ];
    }
}
