<?php

namespace LBF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LBFUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
