<?php

namespace NiceForNow\HairCare\Api;

interface PostManagementInterface
{

    /**
     * @param string $condition_id
     * @return string mixed
     *
     */

    public function getSubCondition();
}
