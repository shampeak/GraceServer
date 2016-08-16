<?php

namespace Grace\Base;

/**
 * ModelInterface
 */
interface ModelInterface
{

    /**
     * 返回依赖关系
     *
     * @param string $key
     */
    public function depend();


}
