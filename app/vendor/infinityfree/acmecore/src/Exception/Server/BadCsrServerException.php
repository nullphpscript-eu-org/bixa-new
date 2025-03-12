<?php

/*
 * This file is part of the Acme PHP project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace InfinityFree\AcmeCore\Exception\Server;

use InfinityFree\AcmeCore\Exception\AcmeCoreServerException;
use Psr\Http\Message\RequestInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class BadCsrServerException extends AcmeCoreServerException
{
    public function __construct(RequestInterface $request, string $detail, \Exception $previous = null)
    {
        parent::__construct(
            $request,
            '[badCSR] The CSR is unacceptable (e.g., due to a short key): '.$detail,
            $previous
        );
    }
}
