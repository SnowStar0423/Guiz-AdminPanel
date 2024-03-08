<?php

declare(strict_types=1);

namespace Kreait\Firebase\JWT;

use Beste\Clock\SystemClock;
use GuzzleHttp\Client;
use InvalidArgumentException;
use Kreait\Firebase\JWT\Action\FetchGooglePublicKeys\WithGuzzle;
use Kreait\Firebase\JWT\Action\FetchGooglePublicKeys\WithPsr6Cache;
use Kreait\Firebase\JWT\Action\VerifySessionCookie;
use Kreait\Firebase\JWT\Action\VerifySessionCookie\Handler;
use Kreait\Firebase\JWT\Action\VerifySessionCookie\WithLcobucciJWT;
use Kreait\Firebase\JWT\Contract\Token;
use Kreait\Firebase\JWT\Error\SessionCookieVerificationFailed;
use Psr\Cache\CacheItemPoolInterface;

final class SessionCookieVerifier
{
    private Handler $handler;

    private ?string $expectedTenantId = null;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public static function createWithProjectId(string $projectId): self
    {
        $clock = SystemClock::create();
        $keyHandler = new WithGuzzle(new Client(['http_errors' => false]), $clock);

        $keys = new GooglePublicKeys($keyHandler, $clock);
        $handler = new WithLcobucciJWT($projectId, $keys, $clock);

        return new self($handler);
    }

    public static function createWithProjectIdAndCache(string $projectId, CacheItemPoolInterface $cache): self
    {
        $clock = SystemClock::create();

        $innerKeyHandler = new WithGuzzle(new Client(['http_errors' => false]), $clock);
        $keyHandler = new WithPsr6Cache($innerKeyHandler, $cache, $clock);

        $keys = new GooglePublicKeys($keyHandler, $clock);
        $handler = new WithLcobucciJWT($projectId, $keys, $clock);

        return new self($handler);
    }

    public function withExpectedTenantId(string $tenantId): self
    {
        $generator = clone $this;
        $generator->expectedTenantId = $tenantId;

        return $generator;
    }

    public function execute(VerifySessionCookie $action): Token
    {
        if ($this->expectedTenantId) {
            $action = $action->withExpectedTenantId($this->expectedTenantId);
        }

        return $this->handler->handle($action);
    }

    /**
     * @throws SessionCookieVerificationFailed
     */
    public function verifySessionCookie(string $sessionCookie): Token
    {
        return $this->execute(VerifySessionCookie::withSessionCookie($sessionCookie));
    }

    /**
     * @throws InvalidArgumentException on invalid leeway
     * @throws SessionCookieVerificationFailed
     */
    public function verifySessionCookieWithLeeway(string $sessionCookie, int $leewayInSeconds): Token
    {
        return $this->execute(VerifySessionCookie::withSessionCookie($sessionCookie)->withLeewayInSeconds($leewayInSeconds));
    }
}
