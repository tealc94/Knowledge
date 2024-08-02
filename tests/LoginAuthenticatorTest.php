<?php

namespace App\Tests\Security;

use App\Security\LoginAuthenticator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginAuthenticatorTest extends TestCase
{
    private $urlGenerator;
    private $authorizationChecker;

    protected function setUp(): void
    {
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->authorizationChecker = $this->createMock(AuthorizationCheckerInterface::class);
    }

    public function testOnAuthenticationSuccessForUser()
    {        
        $this->authorizationChecker->expects($this->once())
            ->method('isGranted')
            ->with('ROLE_ADMIN')
            ->willReturn(false); 

        $this->urlGenerator->expects($this->once())
            ->method('generate')
            ->with('app_home')
            ->willReturn('/home'); 

        // Authenticator creation
        $authenticator = new class($this->urlGenerator, $this->authorizationChecker) extends LoginAuthenticator {};

        $request = new Request();
        $token = $this->createMock(TokenInterface::class);

        // Calling the onAuthenticationSuccess method
        $response = $authenticator->onAuthenticationSuccess($request, $token, 'main');

        // Check that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Check target URL in response
        $expectedUrl = '/home';
        $this->assertEquals($expectedUrl, $response->headers->get('Location'));
    }
}